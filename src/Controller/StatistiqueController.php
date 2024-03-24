<?php

namespace App\Controller;

use App\Repository\DemandeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StatistiqueController extends AbstractController
{
    #[Route('/statistique', name: 'app_statistique')]
    public function index(DemandeRepository $demandes): Response
    {

        $statistiquesDemandeParMatiere = $demandes->getDemandesByMatiere();



        return $this->render('statistique/index.html.twig', [
            'controller_name' => 'StatistiqueController',
            'demandes' => $statistiquesDemandeParMatiere,
        ]);
    }
}
