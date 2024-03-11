<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserPasswordConfirmationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index()
    {
        return $this->render('test/index.html.twig', [
            'form' => 'TestController',
        ]);

    }
}
