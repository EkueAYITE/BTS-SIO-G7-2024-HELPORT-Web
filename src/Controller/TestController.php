<?php

namespace App\Controller;

use Studoo\Api\EcoleDirecte\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        $client = new Client([
            "client_id" => "flore",
            "client_secret" => "test",
        ]);
        echo "<h1>API ECOLE DIRECTE via DotEnv</h1>";
// Recupération du token et profile
        $etudiant = $client->fetchAccessToken();
        echo "Token: {$etudiant->getToken()} <br>";
        echo "Email: {$etudiant->getEmail()} <br>";
        echo "Nom: {$etudiant->getNom()} <br>";
        echo "Prenom: {$etudiant->getPrenom()} <br>";
        echo "Identifiant: {$etudiant->getIdentifiant()} <br>";
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
}
