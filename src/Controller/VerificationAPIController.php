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
        echo "<h1>API ECOLE DIRECTE via Form</h1>";
        echo "<form method='post'>";
        echo  "<label for='username'> Username </label>";
        echo  "<input type='text' name='username' id='username' required>";
        echo "<label for 'password'> Password </label>";
        echo "<input type='password' name='password' id='password' required>";
        echo "<input type='submit' value='Envoyer'>";
        echo "</form";

        return $this->render('verification_api/index.html.twig', [
            'controller_name' => 'VerificationAPIController',
        ]);
    }
}

