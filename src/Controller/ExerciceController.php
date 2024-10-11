<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Form\ExerciceType;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ExerciceController extends AbstractController
{
    public function __construct(private readonly ExerciceRepository $exerciceRepository, private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/exercice', name: 'liste.exercice')]
    public function index(): Response
    {
        $exercices = $this->exerciceRepository->findAll();
        return $this->render('exercice/liste.html.twig', [
            'controller_name' => 'ExerciceController',
            'exercices' => $exercices
        ]);
    }

    #[Route(path: '/exercice/new', name: 'new.exercice')]
    public function new(Request $request){

        $exercice = new Exercice();
        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->em->persist($exercice);
            $this->em->flush();
            $this->addFlash('success', 'creer avec succes');

            return $this->redirectToRoute('liste.exercice');
        }
        return $this->render('exercice/new.html.twig', [
            'controller_name' => 'ExerciceController', 'form' => $form->createView(),
        ]);
    }

    #[Route(path: '/exercice/{id}/edit', name: 'exercice.edit')]
    public function edit (Exercice $exercice, Request $request){

        $form = $this->createForm(ExerciceType::class, $exercice);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

                $this->em->flush();
                $this->addFlash('success', 'Modifier avec succès');
                return $this->redirectToRoute('liste.exercice');
        }

        return $this->render('exercice/edit.html.twig', [
            'exercice' => $exercice, 'form' => $form->createView()]);
    }
}
