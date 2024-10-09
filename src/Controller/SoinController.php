<?php

// src/Controller/SoinController.php

namespace App\Controller;

use App\Service\DiseaseService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SoinController extends AbstractController
{
    private $diseaseService;

    public function __construct(DiseaseService $diseaseService) // Injection de dépendance
    {
        $this->diseaseService = $diseaseService;
    }

    #[Route('/soin', name: 'soin')]
    public function index(): Response
    {
        $diseases = $this->diseaseService->getDiseases(); // Appel au service

        return $this->render('security/soin.html.twig', [
            'controller_name' => 'SoinController',
            'diseases' => $diseases, // Passez les données à la vue
        ]);
    }
}