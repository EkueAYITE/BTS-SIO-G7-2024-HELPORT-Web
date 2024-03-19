<?php

namespace App\Controller;

use App\Entity\Matiere;
use App\Repository\MatiereRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MatiereJsonController extends AbstractController
{
    #[Route('/matiere/json', name: 'app_matiere_json')]
    public function index(MatiereRepository $matiereRepository): JsonResponse
    {
        $matiere=$matiereRepository->findAll();
        return new JsonResponse(["data"=>array_map(function (Matiere $matiere){
            return[
                "id"=>$matiere->getId(),
                "designation"=>$matiere->getDesignation(),
                "sous_matiere"=>$matiere->getSousMatiere()
            ];
        },$matiere)]);

    }

}
