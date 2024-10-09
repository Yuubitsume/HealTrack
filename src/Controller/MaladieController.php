<?php

namespace App\Controller;

use App\Entity\Maladie;
use App\Form\MaladieType;
use App\Repository\MaladieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MaladieController extends AbstractController
{

    public function __construct(private readonly MaladieRepository $maladieRepository, private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/maladie', name: 'liste.maladie')]
    public function index(): Response
    {
        $maladies = $this->maladieRepository->findAll();
        return $this->render('maladie/liste.html.twig', [
            'controller_name' => 'MaladieController',
            'maladies' => $maladies
        ]);
    }

    #[Route(path: '/maladie/new', name: 'new.maladie')]
    public function new(Request $request){

        $maladie = new Maladie();
        $form = $this->createForm(MaladieType::class, $maladie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($maladie);
            $this->em->flush();
            $this->addFlash('success', 'creer avec succes');

            return $this->redirectToRoute('liste.maladie');
        }

        return $this->render('maladie/new.html.twig', [
            'controller_name' => 'MaladieController', 'form' => $form->createView(),
        ]);
    }

   
    #[Route(path: '/maladie/{id}/edit', name: 'maladie.edit')]
    public function edit (Maladie $maladie, Request $request){

        $form = $this->createForm(MaladieType::class, $maladie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $this->em->flush();
                $this->addFlash('success', 'Modifier avec succès');
                return $this->redirectToRoute('liste.maladie');
        }

        return $this->render('maladie/edit.html.twig', [
            'maladie' => $maladie, 'form' => $form->createView()]);
    }

}
