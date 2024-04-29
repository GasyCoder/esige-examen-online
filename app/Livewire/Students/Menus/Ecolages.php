<?php

namespace App\Livewire\Students\Menus;

use App\Models\User;
use App\Models\Ecolage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Ecolages extends Component
{   
    use LivewireAlert, AuthorizesRequests, WithPagination, WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $ecolageParClasse = [
        1 => 100000, // L1
        2 => 200000, // L2
        3 => 300000, // L3
        4 => 400000, // M1
        5 => 500000, // M2
    ];

    public $motif;
    public $mode;
    public $datePay;
    public $tranche;
    public $file_joint;
    public function render()
    {   
        $user = auth()->user();
        $ecolages = Ecolage::where('user_id', $user->id)
        ->orderBy('datePay', 'desc')->paginate(10);
        $payEcolage = Ecolage::where('status', 'paye')->where('user_id', $user->id)->sum('tranche');
        $totalMois = 10-$payEcolage;
        return view('livewire.students.menus.ecolages.index', [

            'ecolages' => $ecolages,
            'totalMois'  => $totalMois,

        ])->layout('layouts.student');
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

        $user      = Auth::user();

        $derniereEcolage = Ecolage::where('user_id', $user->id)
        ->latest()
        ->first();

        $moisRestants = $derniereEcolage ? $derniereEcolage->mois_restants : 10;
        $moisRestants -= $this->tranche;
        
        $file_pieces = $this->file_joint ? $this->file_joint->store('ecolages', 'public') : null;
        $ecolage = Ecolage::create([
            'user_id'   => $user->id,
            'motif'     => $this->motif,
            'mode'      => $this->mode,
            'datePay'   => $this->datePay,
            'tranche'   => $this->tranche,
            'amount'    => $this->tranche * $this->ecolageParClasse[$user->classe_id],
            'status'    => 'pending',
            'received'  => 'Moi-même',
            'mois_restants' => $moisRestants,
            'file_joint'    => $file_pieces,
        ]);

        //$etudiant->notify((new EtudiantCompteCreation())->onQueue('notifications'));
        //dd($ecolage);
        
        $this->reset();
        $this->alert('success', 'Ecolage successfully saved.');
        return redirect()->route('myecolage');
    }
}
