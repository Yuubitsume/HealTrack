<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\RoleRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class InscriptionController extends AbstractController
{
    public function __construct(private readonly UserRepository $userRepository, private readonly EntityManagerInterface $em, private readonly RoleRepository $roleRepository)
    {
    }

    #[Route('/inscription', name: 'inscription')]
    public function index(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    {

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && !$form->isValid()) {
            $user = $form->getData();
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);
           
            if($user->getSpeciality() !== null){
                $role = $this->roleRepository->findOneBy(['name' => "ROLE_MEDECIN"]);
                $user->addRole($role);
            }else{
                $role = $this->roleRepository->findOneBy(['name' => "ROLE_PATIENT"]);
                $user->addRole($role);
            }
            $this->em->persist($user);
            $this->em->flush();
            $this->addFlash('success', 'creer avec succes');

            return $this->redirectToRoute('login');
        }
        $error = null;
        $username = null;
        return $this->render('security/inscription.html.twig', [
            'controller_name' => 'InscriptionController',
            'hasError' => $error !== null,
            'username' => $username,
            'form' => $form->createView()
        ]);
    }
}