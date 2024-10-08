<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function index(): Response
    {
        $error = null;
        $username = null;
        return $this->render('security/login.html.twig', [
            'controller_name' => 'SecurityController',
            'hasError' => $error !== null,
            'username' => $username,
        ]);
    }
}
