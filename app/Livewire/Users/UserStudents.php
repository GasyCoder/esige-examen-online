<?php

namespace App\Livewire\Users;

use App\Models\User;
use App\Models\Ecolage;
use Livewire\Component;
use Livewire\WithPagination;
use App\Services\ClasseService;
use App\Services\ParcourService;
use App\Services\EtudiantService;
use Spatie\Permission\Models\Role;
use App\Jobs\SendEmailNotification;
use App\Services\UserStudentService;
use App\Notifications\EtudiantCompteCreation;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserStudents extends Component
{   
    use LivewireAlert, AuthorizesRequests, WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $student_id;
    public $motif;
    public $mode;
    public $datePay;
    public $tranche;
    public $file_joint;
    public $user;
    public $payIdStudent;
    public $page = 10;
    public $etudiants = [];
    public $classes, $parcours;
    public $ecolageParClasse = [
        1 => 100000, // L1
        2 => 200000, // L2
        3 => 300000, // L3
        4 => 400000, // M1
        5 => 500000, // M2
    ];
    public function active($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => false,
        ]);
        $this->alert('success', 'Desactivé Etudiant!');
    }

    public function desactive($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_active' => true,
        ]);
        $this->alert('success', 'Activé Etudiant!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        $this->alert('success', 'En archive cette étudiant!');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $user->restore();

        $this->alert('success', 'Etudiant a été restauré!');
        return redirect()->route('user_students');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);

        $user->forceDelete();

        $this->alert('success', 'Etudiant a été supprimé définitivement!');
        return redirect()->route('user_students');
    }

    protected $rules = [
        'selectedStudentIds' => 'required|array',
        'password' => 'required|string|min:8|confirmed',
    ];

    public function getTotalTranschesByStudents($students)
    {
        $totalTransches = [];
        foreach ($students as $student) {
            $totalTransches[$student->id] = $this->getTotalTranschesByStudent($student->id);
        }
        return $totalTransches;
    }

    public function getTotalTranschesByStudent($userId)
    {
        $user = User::findOrFail($userId);
        return $user->ecolages()->where('status', 'paye')->sum('tranche');
    }

    public function render(ClasseService $classeService, ParcourService $parcourService, EtudiantService $etudiantService)
    {
        $title = 'Utilisateurs';

        $this->classes = $classeService->getClasses();
        $this->parcours = $parcourService->getParcours();
        $this->etudiants = $etudiantService->getEtudiants();

        $studentsPaginated = User::role('student')->withoutTrashed()->latest()->paginate($this->page);
        $totalTranschesByStudent = $this->getTotalTranschesByStudents($studentsPaginated);

        return view('livewire.users.students', [
            
            'title' => $title,
            'students' => $studentsPaginated,
            'countStudent' => User::role('student')->withoutTrashed()->count(),
            'archives'  => User::role('student')->onlyTrashed()->latest()->paginate($this->page),
            
            'countArchive' => User::role('student')->onlyTrashed()->count(),
            'totalTranschesByStudent' => $totalTranschesByStudent,
        ]);
    }

    public function addPaiement($userId)
    {
        $this->user         = User::findOrFail($userId);
        $this->payIdStudent = $userId;

        // Accéder à l'ID de la classe de l'étudiant
        $classeId = $this->user->classe_id;

        // Utiliser l'ID de la classe pour obtenir la valeur de l'écolage
        $this->tranche = $this->ecolageParClasse[$classeId];
    }

    public function save()
    {
        $this->validate([
            'motif' => 'required',
            'mode' => 'required',
            'datePay' => 'required|date',
            'tranche' => 'required|numeric',
            'file_joint' => 'nullable',
        ]);

        $derniereEcolage = Ecolage::where('user_id', $this->payIdStudent)
        ->latest()
        ->first();

        $moisRestants = $derniereEcolage ? $derniereEcolage->mois_restants : 10;
        $moisRestants -= $this->tranche;
        $etudiant = User::findOrFail($this->payIdStudent);
        $ecolage = Ecolage::create([
            'user_id'   => $this->payIdStudent,
            'motif'     => $this->motif,
            'mode'      => $this->mode,
            'datePay'   => $this->datePay,
            'tranche'   => $this->tranche,
            'amount'    => $this->tranche * $this->ecolageParClasse[$etudiant->classe_id],
            'status'    => 'paye',
            'received'  => 'Admin',
            'mois_restants' => $moisRestants,
        ]);

        $etudiant->update([
            'is_active' => true,
        ]);

        //$etudiant->notify(new EtudiantCompteCreation());
        //SendEmailNotification::dispatch($etudiant);
        $etudiant->notify((new EtudiantCompteCreation())->onQueue('notifications'));
        //dd($ecolage);
        
        $this->reset();
        $this->alert('success', 'Ecolage successfully saved.');
        return redirect()->route('user_students');
    }
}
