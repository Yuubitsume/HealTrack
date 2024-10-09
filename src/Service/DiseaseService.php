<?php

// src/Service/DiseaseService.php

namespace App\Service;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

class DiseaseService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'verify' => false, // Désactive la vérification SSL
        ]);
    }

    public function getDiseases(): array
    {
        try {
            // Utilisez l'URL correcte pour récupérer les maladies
            $response = $this->client->request('GET', 'https://api.digital.nhs.uk/conditions');
            $data = json_decode($response->getBody()->getContents(), true);
            var_dump($data);
            return $data['diseases'] ?? [];
        } catch (GuzzleException $e) {
            // Affichez l'erreur pour le débogage
            dd('Erreur lors de la récupération des maladies: ' . $e->getMessage());
        }
            return [];
        }
    }