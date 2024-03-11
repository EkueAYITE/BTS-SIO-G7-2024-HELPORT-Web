<?php

namespace App\Controller;

use App\Entity\User;
use ContainerQRDPOxy\getMailer_TransportFactory_SendmailService;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use PhpParser\Node\Expr\Array_;
use PHPUnit\Util\Exception;
use Studoo\Api\EcoleDirecte\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;
use function Symfony\Component\DependencyInjection\Loader\Configurator\abstract_arg;

class VerificationAPIController extends AbstractController
{
    #[Route('/verification', name: 'app_verification_a_p_i')]
    public function index(TokenGeneratorInterface $tokenGenerator, SessionInterface $session,  JWTTokenManagerInterface $JWTManager, MailerInterface $mailer, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordEncoder): Response
    {

        $errorMessage = null;
        if (isset($_POST['username']) && isset($_POST['password'])) {
            try {
                // Vérification de l'API
                $client = new Client([
                    "client_id" => $_POST['username'],
                    "client_secret" => $_POST['password'],
                    "base_path" => "http://localhost:9042",
                    "mock" => true,
                ]);



               //dd($client->fetchAccessToken());

                    $etudiantData = $client->fetchAccessToken();
                    $email = $etudiantData->getEmail();
                    $session->set('email', $email);
                    $token = $tokenGenerator->generateToken();
                    //dump($token);

                    $etudiant = new User();

                    $etudiantProfil = $etudiantData->getProfile();
                    if ($etudiantProfil['sexe'] === 'F') {
                        $etudiantSexe = 1;
                    } else {
                        $etudiantSexe = 2;
                    }

                   // dd($etudiantProfil);

                    $etudiant->setPrenom($etudiantData->getPrenom());
                    $etudiant->setNom($etudiantData->getNom());
                    $etudiant->setSexe($etudiantSexe);
                    $etudiant->setEmail($etudiantData->getEmail());
                    $etudiant->setNiveau($etudiantProfil['classe']['libelle']);
                    $etudiant->setRoles(['ROLE_USER']);
                    $hashedPassword = $passwordEncoder->hashPassword($etudiant, $token);
                    $etudiant->setPassword($hashedPassword);
                    $etudiant->setTelephone($etudiantProfil['telPortable']);
                    //var_dump($etudiant);

                    $tokenModification = $JWTManager->create($etudiant);
                    $entityManager->persist($etudiant);
                    $entityManager->flush();
                   // var_dump($entityManager);

                    $emailEtudiant = $client->fetchAccessToken()->getEmail();

                    $email = (new Email())
                        ->from('hello@example.com')
                        ->to($emailEtudiant)
                        ->subject('Time for Symfony Mailer!')
                        ->text('Sending emails is fun again!')
                        ->html('<p>See Twig integration for better HTML integration!</p><br><a href="http://127.0.0.1:8000/mdpCreation/'. $tokenModification.'">Modifier mot de passe</a>');
                    //var_dump($token);
                    $mailer->send($email);



                    // Redirection si la vérification est un succès
                    return $this->render('inscription/redirection-mail.html.twig', [
                        'controller_name' => 'VerificationAPIController',
                    ]);


                } catch (\Exception $exception) {
                    $errorMessage = "Identifiants invalides. Veuillez réessayer.";
                   //dd($exception);
                }


            }
            // Affichage du formulaire si la vérification échoue ou si aucune donnée POST n'est fournie
            return $this->render('verification_api/index.html.twig', [
                'controller_name' => 'VerificationAPIController',
                'errorMessage' => $errorMessage,
            ]);
        }
    }


