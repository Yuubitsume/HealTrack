<?php

// src/Controller/listeMaladieController.php

namespace App\Controller;

use App\Service\DiseaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class listeMaladieController extends AbstractController
{
    private $diseaseService;

    public function __construct(DiseaseService $diseaseService) // Injection de dépendance
    {
        $this->diseaseService = $diseaseService;
    }

    #[Route('/liste_Maladie', name: 'listeMaladie')]
    public function index(): Response
    {
        $diseases = $this->diseaseService->getDiseases(); // Appel au service

        return $this->render('security/liste_maladie.html.twig', [
            'controller_name' => 'listeMaladieController',
            'diseases' => $diseases, // Passez les données à la vue
        ]);
    }
}