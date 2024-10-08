<?php

namespace App\Controller;

use App\Entity\Role;
use App\Form\RoleType;
use App\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RoleController extends AbstractController
{
    public function __construct(private readonly RoleRepository $roleRepository, private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/role/liste', name: 'role_liste')]
    public function index(Request $request)
    {
        $roles = $this->roleRepository->findBy([], ['id' => 'DESC']);
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($role);
            $this->em->flush();
            $this->addFlash('success', 'creer avec succes');
            return $this->redirectToRoute('role_liste');
        }
        return $this->render('role/liste_role.html.twig', [
            'form' => $form->createView(), 'roles' => $roles,
        ]);
    }

    #[Route(path: '/role/{id}/edit', name: 'role_edit')]
    public function edit (Role $role, Request $request){

        $form = $this->createForm(RoleType::class, $role);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
                $this->em->flush();
                $this->addFlash('success', 'Modifier avec succès');
                return $this->redirectToRoute('role_liste');
        }
        return $this->render('role/edit_role.html.twig', [
            'role' => $role, 'form' => $form->createView()]);
    }

}
