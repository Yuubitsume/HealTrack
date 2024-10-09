<?php

// src/Controller/SoinController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SoinController extends AbstractController
{
    #[Route('/soin', name: 'soin')]
    public function index(): Response
    {
   
        return $this->render('security/soin.html.twig', [
            'controller_name' => 'SoinController',
        
        ]);
    }
}