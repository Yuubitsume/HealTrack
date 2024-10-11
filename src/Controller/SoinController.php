<?php

// src/Controller/SoinController.php

namespace App\Controller;

use App\Repository\ExerciceRepository;
use App\Repository\MaladieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class SoinController extends AbstractController
{
    public function __construct(private readonly MaladieRepository $maladieRepository, private readonly EntityManagerInterface $em)
    {
    }

    #[Route('/soin', name: 'soin')]
    public function index(): Response
    {
        $maladies = $this->maladieRepository->findAll();
        return $this->render('security/soin.html.twig', [
            'controller_name' => 'SoinController',
            'maladies' => $maladies
        
        ]);
    }

   
    #[Route('/search', name: 'app_search')]
    public function search(Request $request, MaladieRepository $maladieRepository): Response
    {
        // Récupérer la valeur du paramètre 'option' depuis la requête GET
        $option = $request->query->get('option');
        $value = intval($option);
        if (!$option) {
            return new JsonResponse(['message' => 'Aucune option sélectionnée.'], 400);
        }

        // Rechercher dans la base de données avec l'option sélectionnée
        $maladie = $maladieRepository->find($value);
        $results = $maladie->getExercices();
       
        $data = [];
        foreach($results as $result){
            $data[] = [
                'name' => $result->getName(),
                'description' => $result->getDescription()
            ];
        }

        return new JsonResponse($data);
    }
}