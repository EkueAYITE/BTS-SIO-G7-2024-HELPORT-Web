<?php

namespace App\Controller;

use ContainerQRDPOxy\getMailer_TransportFactory_SendmailService;
use Studoo\Api\EcoleDirecte\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class VerificationAPIController extends AbstractController
{
    #[Route('/verification', name: 'app_verification_a_p_i')]
    public function index(TokenGeneratorController $tokenGenerate, MailerInterface $mailer): Response
    {

        $errorMessage = null;
        if (isset($_POST['username']) && isset($_POST['password'])) {

                $client = new Client([
                    "client_id" => $_POST['username'],
                    "client_secret" => $_POST['password'],
                    "base_path" => "http://localhost:9042",
                    "mock" => true,
                ]);

                /*if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }*/

                try {
                    // Vérification de l'API
                    $etudiant = $client->fetchAccessToken();
                    //$tokenGenerate->token();

                    $email = (new Email())
                        ->from('send@OrtMontreuil.fr')
                        ->to('eleve.ort@ortMontreuil.fr')
                        //->cc('cc@example.com')
                        //->bcc('bcc@example.com')
                        //->replyTo('fabien@example.com')
                        //->priority(Email::PRIORITY_HIGH)
                        ->subject('Time for Symfony Mailer!')
                        ->text('Sending emails is fun again!')
                        ->html('<p>Bonjour, connecte toi par <a href="http://127.0.0.1:8000/mdpCreation">ici</a></p>');

                    $mailer->send($email);



                    // Redirection si la vérification est un succès
                    return $this->render('inscription/redirection-mail.html.twig', [
                        'controller_name' => 'VerificationAPIController',
                    ]);


                } catch (\Exception $exception) {
                    $errorMessage = "Identifiants invalides. Veuillez réessayer.";
                }


            }
            // Affichage du formulaire si la vérification échoue ou si aucune donnée POST n'est fournie
            return $this->render('verification_api/index.html.twig', [
                'controller_name' => 'VerificationAPIController',
                'errorMessage' => $errorMessage,
            ]);
        }
    }


