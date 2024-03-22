<?php

namespace App\Controller;

use App\Repository\DemandeRepository;
use App\Repository\MatiereRepository;
use Doctrine\Migrations\Exception\UnknownMigrationVersion;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MesDemandesController extends AbstractController
{
    #[Route('/mes/demandes', name: 'app_mes_demandes')]
    public function mesdemandes(DemandeRepository $demandeRepository, MatiereRepository $matiereRepository): Response
    {
        $user = $this->getUser();

        return $this->render('mes_demandes/index.html.twig', [
            'controller_name' => 'MesDemandesController',
            'demandes' => $demandeRepository->getDemandesByUser($user),
        ]);
    }
}
