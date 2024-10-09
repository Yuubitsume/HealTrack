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
            'verify' => false, // Désactive la vérification SSL (à utiliser avec prudence)
        ]);
    }

    public function getDiseases(): array
    {
        try {
            $response = $this->client->request('GET', 'https://api.fda.gov/drug/event.json?search=patient.drug.medicinalproduct:"aspirin"&limit=10');
            $data = json_decode($response->getBody()->getContents(), true);
    
            if (isset($data['results'])) {
                $diseases = [];
                foreach ($data['results'] as $result) {
                    foreach ($result['patient']['reaction'] as $reaction) {
                        // Ajoutez chaque réaction et produit au tableau
                        $diseases[] = [
                            'reaction' => $reaction['reactionmeddrapt'] ?? 'Non spécifié', // S'assurer que la clé existe
                        ];
                    }
                }
    
                return $diseases; // Retournez le tableau des maladies
            }
            return []; // Aucune maladie trouvée
    
        } catch (GuzzleException $e) {
            dd('Erreur lors de la récupération des maladies: ' . $e->getMessage());
        }
    }    
}
