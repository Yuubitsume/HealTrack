<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'home_back')]
    public function index(): Response
    {
       /* if ($this->isGranted('ROLE_MEDECIN')) {
            return $this->redirectToRoute('admin_dashboard'); // Route pour les administrateurs
        }*/

        if ($this->isGranted('ROLE_PATIENT')) {
            return $this->redirectToRoute('home'); // Route pour les patiens
        }

        return $this->render('accueil/home_back.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}