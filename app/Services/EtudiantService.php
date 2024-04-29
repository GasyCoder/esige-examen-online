<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;

class EtudiantService
{
    protected $client;

    public function __construct()
    {

        $config = config('services.scolx');

        // dd($config);

        $this->client = new Client([
            'base_uri' => $config['base_uri'],
            'headers' => [
                'Authorization' => 'Bearer ' . $config['token'],
            ],
        ]);
    }


    public function getEtudiants()
    {
        $response = $this->client->get('api/etudiants');

        if ($response->getStatusCode() == 200) {
            $etudiants = json_decode($response->getBody(), true);
            //dd($etudiants);
            return collect($etudiants)
                ->filter(function ($etudiant) {
                    return $etudiant['isActive'] === true && $etudiant['typeFormation'] === true;
                })->all();
        }

        return [];
    }

    public function findById($id)
    {
        $etudiants = $this->getEtudiants();
        foreach ($etudiants as $etudiant) {
            if ($etudiant['id'] == $id) {
                return $etudiant;
            }
        }
        return null;
    }

    public function count()
    {
        $etudiants = $this->getEtudiants();
        $emailsExistants = User::pluck('email')->toArray();
        $count = 0;

        foreach ($etudiants as $etudiant) {
            if ($etudiant['isActive'] === true
                && $etudiant['typeFormation'] === false
                && !in_array(strtolower($etudiant['email']), array_map('strtolower', $emailsExistants))
            ) {
                $count++;
            }
        }

        return $count;
    }

}