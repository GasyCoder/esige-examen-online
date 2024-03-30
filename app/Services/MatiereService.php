<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;

class MatiereService
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

    public function findById($id)
    {
        $matieres = $this->getMatieres();
        foreach ($matieres as $matiere) {
            if ($matiere['id'] == $id) {
                return $matiere;
            }
        }
        return null;
    }


    public function getMatieres()
    {
        $response = $this->client->get('api/matieres');

        if ($response->getStatusCode() == 200) {
            $matieres = json_decode($response->getBody(), true);
            //dd($matieres);
            return collect($matieres)->all();
        }
        return [];
    }
}