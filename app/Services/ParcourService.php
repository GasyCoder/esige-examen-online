<?php

namespace App\Services;

use GuzzleHttp\Client;

class ParcourService
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
        $parcours = $this->getParcours();
        foreach ($parcours as $parcour) {
            if ($parcour['id'] == $id) {
                return $parcour;
            }
        }
        return null;
    }


    public function getParcours()
    {
        $response = $this->client->get('api/parcours');
        if ($response->getStatusCode() == 200) {
            $parcours = json_decode($response->getBody(), true);
            //dd($parcours);
            return collect($parcours)->all();
        }
        return [];
    }

    
}