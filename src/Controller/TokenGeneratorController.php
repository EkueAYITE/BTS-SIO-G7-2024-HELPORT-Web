<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TokenGeneratorController extends AbstractController
{
    #[Route('/tokengenerator', name: 'app_token_generator')]
    public function token(): Response
    {
        // Token
        $token = $this->generateRandomToken();

        var_dump($token);

        return $this->render('token_generator/index.html.twig', [
            'controller_name' => 'TokenGeneratorController',
            'generated_token' => $token,
        ]);
    }

    private function generateRandomToken(int $length = 50): string
    {
        // Caractères possibles pour le token
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-!?;.';

        $token = '';

        // Générer le token en sélectionnant aléatoirement les caractères
        for ($i = 0; $i < $length; $i++) {
            $token .= $characters[random_int(0, strlen($characters) - 1)];
        }

        return $token;
    }
}
