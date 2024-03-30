<?php

namespace App\Services;

use App\Models\User;
use GuzzleHttp\Client;

class ClasseService
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
        $classes = $this->getClasses();
        foreach ($classes as $class) {
            if ($class['id'] == $id) {
                return $class;
            }
        }
        return null;
    }


    public function getClasses()
    {
        $response = $this->client->get('api/classes');

        if ($response->getStatusCode() == 200) {
            $classes = json_decode($response->getBody(), true);
            //dd($classes);
            return collect($classes)->all();
        }
        return [];
    }
}