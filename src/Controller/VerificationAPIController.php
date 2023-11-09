<?php

namespace App\Controller;

use Studoo\Api\EcoleDirecte\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VerificationAPIController extends AbstractController
{
    #[Route('/verification', name: 'app_verification_a_p_i')]
    public function index(): Response
    {
        if (isset($_POST['username']) && isset($_POST['password'])) {
            $client = new Client([
                "client_id" => $_POST['username'],
                "client_secret" => $_POST['password'],
                "base_path" => "http://localhost:9042",
                "mock" => true,
            ]);

            // Vérification de l'API
            $etudiant = $client->fetchAccessToken();

            // Redirection si la vérification est un succès
            return $this->render('inscription/redirection-mail.html.twig', [
                'controller_name' => 'VerificationAPIController',
            ]);
        }

        // Affichage du formulaire si la vérification échoue ou si aucune donnée POST n'est fournie
        return $this->render('verification_api/index.html.twig', [
            'controller_name' => 'VerificationAPIController',
        ]);
    }
}

