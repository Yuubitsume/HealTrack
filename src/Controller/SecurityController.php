<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    public function __construct(
        private readonly ? \Symfony\Component\Security\Csrf\CsrfTokenManagerInterface $tokenManager = null
    )
    {
    }
    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $username = $authenticationUtils->getLastUsername();
        $csrfToken = $this->tokenManager
        ? $this->tokenManager->getToken('authenticate')->getValue()
        : null;
        return $this->render('security/login.html.twig', [
            'hasError' => $error !== null,
            'username' => $username,
            'csrf_token' => $csrfToken
        ]);
    }

    #[Route(path: '/logout', name: 'logout')]
    public function logout()
    {
    }
}
