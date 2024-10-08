<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    #[Route('/inscription', name: 'inscription')]
    public function index(): Response
    {
        $error = null;
        $username = null;
        return $this->render('security/inscription.html.twig', [
            'controller_name' => 'InscriptionController',
            'hasError' => $error !== null,
            'username' => $username,
        ]);
    }
}