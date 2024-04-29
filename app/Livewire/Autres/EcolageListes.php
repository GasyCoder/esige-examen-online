<?php

namespace App\Livewire\Autres;

use App\Models\Ecolage;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Services\ClasseService;
use App\Services\ParcourService;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EcolageListes extends Component
{
    use LivewireAlert, AuthorizesRequests, WithFileUploads;
    public $page = 10;
    public $restantMois;
    public $montantPending, $amountAccepted, $amountCancel, $amountArchive;
    public $classes, $parcours;
    public function render(ClasseService $classeService, ParcourService $parcourService)
    {   
        $this->classes = $classeService->getClasses();
        $this->parcours = $parcourService->getParcours();

        $ecolagesPending            = Ecolage::query()->latest()->where('status', 'pending')->paginate($this->page);
        $ecolagesAccepted           = Ecolage::query()->latest()->where('status', 'paye')->paginate($this->page);
        $ecolagesCancel             = Ecolage::query()->latest()->where('status', 'refuse')->paginate($this->page);
        $ecolagesArchive            = Ecolage::query()->latest()->onlyTrashed()->paginate($this->page);

        foreach ($ecolagesPending as $pending) {
            $this->montantPending[$pending->id] = $pending->amount;
        }

        foreach ($ecolagesAccepted as $accpeted) {
            $this->amountAccepted[$accpeted->id] = $accpeted->amount;
        }

        foreach ($ecolagesArchive as $archive) {
            $this->amountArchive[$archive->id] = $archive->amount;
        }

        foreach ($ecolagesCancel as $cancel) {
            $this->amountCancel[$cancel->id] = $cancel->amount;
        }

        return view('livewire.autres.ecolages.index', [

            'title'             => 'Liste des transactions',

            'ecolagesPending'   => $ecolagesPending,
            'ecolagesAccepted'  => $ecolagesAccepted,
            'ecolagesCancel'    => $ecolagesCancel,
            'ecolagesArchive'   => $ecolagesArchive,

            'restantMois'       => $this->restantMois,
            'montantPending'    => $this->montantPending,
            'amountAccepted'    => $this->amountAccepted,

            'countPending'      => Ecolage::query()->latest()->where('status', 'pending')->count(),
            'countAccepted'     => Ecolage::query()->latest()->where('status', 'paye')->count(),
            'countCancel'       => Ecolage::query()->latest()->where('status', 'refuse')->count(),
            'countArchive'      => Ecolage::query()->latest()->onlyTrashed()->count(),

        ]);
    }

    public function payAccepted($id)
    {
        $accepted = Ecolage::findOrFail($id);
        $accepted->update([
            'status' => 'paye',
        ]);
        $this->alert('success', 'Ecolage a été validée avec succès!');
    }

    public function payCancel($id)
    {
        $refuse = Ecolage::findOrFail($id);
        $mois_recover = $refuse->mois_restants + $refuse->tranche;
        $refuse->update([
            'status' => 'refuse',
            'mois_restants' => $mois_recover,
        ]);
        $this->alert('success', 'Ecolage a été refusée!');
    }
    
    public function payRecover($id)
    {
        $recover = Ecolage::findOrFail($id);
        $mois_recover = $recover->mois_restants - $recover->tranche;
        $recover->update([
            'status' => 'paye',
            'mois_restants' => $mois_recover,
        ]);
        $this->alert('success', 'Ecolage a été re-validée avec succès!');
    }

    public function delete($id)
    {
        $ecolage = Ecolage::findOrFail($id);

        $ecolage->delete();

        $this->alert('success', 'Paiement en corbeille !');
    }

    public function restore($id)
    {
        $ecolage = Ecolage::onlyTrashed()->findOrFail($id);

        $ecolage->restore();

        $this->alert('success', 'Paiement a été restauré!');
    }

    public function forceDelete($id)
    {
        $ecolage = Ecolage::onlyTrashed()->findOrFail($id);

        $ecolage->forceDelete();

        $this->alert('success', 'Paiement a été supprimé définitivement!');
    }
}
