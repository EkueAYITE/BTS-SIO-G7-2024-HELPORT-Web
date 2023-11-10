<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MdpCreationController extends AbstractController
{
    #[Route('/mdpCreation', name: 'app_mdp_creation')]
    public function index(): Response
    {







        return $this->render('mdp_creation/index.html.twig', [
            'controller_name' => 'MdpCreationController',
        ]);
    }
}
