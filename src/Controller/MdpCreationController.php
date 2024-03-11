<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\MdpCreationType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\ExpressionLanguage\Token;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;


class MdpCreationController extends AbstractController
{
    #[Route('/mdpCreation/{token}', name: 'app_mdp_creation', methods: ['GET', 'POST'])]
    public function verifierMotDePasse(Request $request, UserPasswordHasherInterface $passwordHasher, JWTEncoderInterface $JWTManager, $token, EntityManagerInterface $em, UserRepository $userRepository): Response
    {
        $errorMessage = null;
        $successMessage = null;
        //todo : récupérer le token de la route le déposé
        // Quand la personne soumet son formulaire on décode le token
        // find le user et changer le mot de passe en base de donné et redirigé vers la connexion

        $payLoad = $JWTManager->decode($token);
        // dd($payLoad);
        $email = $payLoad['username'];
        //dd($email);
        // récupérer le user depuis l'adresse

        $user = $userRepository->findOneBy(['email' => $email]);
        //dd($user);


       /* if (isset($_POST['submitMdp'])) {
            $newPassword = $_POST['password'];
            $confirmedPassword = $_POST['confirm-password'];
            dump($newPassword, $confirmedPassword);

            // Hacher le nouveau mot de passe
            if ($passwordHasher->isPasswordValid($newPassword, $confirmedPassword)) {
                $hashedPassword = $passwordHasher->hashPassword($user, $confirmedPassword);
                $user->setPassword($hashedPassword);
                $em->persist($user);
                $em->flush();
            }*/


            $form = $this->createForm(MdpCreationType:: class);

            $form->handleRequest($request);
            //dd($form);
            // Traitement du formulaire
            if ($form->isSubmitted() && $form->isValid()) {
                dump($user);
                //dd($_POST);
               // dd($passwordHasher->isPasswordValid($user, $form->getData()));

                $newPassword = $form->get('password')->getData();
               $confirmedPassword =$form->get('confirmPassword')->getData();
                dump($newPassword , $confirmedPassword);
                // Hacher le nouveau mot de passe

                    $hashedPassword = $passwordHasher->hashPassword($user, $newPassword);
                    $user->setPassword($hashedPassword);
                    $em->persist($user);
                    $em->flush();

                    $this->addFlash(
                        'succès',
                        'les informations ont été modifier'
                    );



                // Mettre à jour le mot de passe de l'utilisateur
               ;

                // Envoyer un message de confirmation à l'utilisateur
                $this->addFlash('success', 'Votre mot de passe a été changé avec succès.');
                return $this->redirectToRoute('app_connexion');
            }
            else {
                dump("non valide");
                $this->addFlash(
                    'error',
                    'Le mot de passe actuel est incorrect.'
                );
            }

       // }
        return $this->render('mdp_creation/index.html.twig', [
            'form' => $form,
            'errorMessage' => $errorMessage,
            'successMessage' => $successMessage,
        ]);
    }
}

