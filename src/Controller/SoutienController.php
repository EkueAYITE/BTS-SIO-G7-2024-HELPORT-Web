<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Entity\Soutien;
use App\Form\SoutienType;
use App\Repository\DemandeRepository;
use App\Repository\SoutienRepository;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Scalar\String_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/soutien')]
class SoutienController extends AbstractController
{
    #[Route('/', name: 'app_soutien_index', methods: ['GET'])]
    public function index(SoutienRepository $soutienRepository): Response
    {
        return $this->render('soutien/index.html.twig', [
            'soutiens' => $soutienRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_soutien_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, string $id, DemandeRepository $demandeRepository): Response
    {
        // Récupérer l'entité Demande correspondante à partir de l'identifiant
        $demande = $demandeRepository->find($id);

        $soutien = new Soutien();
        $soutien ->setDemande($demande);
        //dd($soutien);
        $form = $this->createForm(SoutienType::class, $soutien);
        $form->handleRequest($request);
        $user = $this->getUser();
        $niveau  = $user->getNiveau();
        // dd($niveau);
        $niveauEtudiant = 0;
        if($niveau =="1 TS SIO A" or $niveau =="1 TS SIO B" or $niveau =="1 TS SIO - année alternance" or $niveau =="Manager Solutions Digitals et Data 1ème - année alternance"){
            $niveauEtudiant =1;
        }elseif ($niveau=="2TS SIO SLAM" or $niveau=="2TS SIO SISR" or $niveau =="2TS SIO SLAM - année alternance" or $niveau =="2TS SIO SISR - année alternance" or $niveau=="Manager Solutions Digitals et Data 2ème - année alternance" ){
            $niveauEtudiant =2;
        }elseif ($niveau=="Bachelor CSI - année alternance"){
            $niveauEtudiant =3;
        }

        $niveauD = $demande->getUser()->getNiveau();
        $niveauDemande = 0;
        if($niveauD =="1 TS SIO A" or $niveauD =="1 TS SIO B" or $niveauD =="1 TS SIO - année alternance" or $niveauD =="Manager Solutions Digitals et Data 1ème - année alternance"){
            $niveauDemande =1;
        }elseif ($niveauD=="2TS SIO SLAM" or $niveauD=="2TS SIO SISR" or $niveauD =="2TS SIO SLAM - année alternance" or $niveauD =="2TS SIO SISR - année alternance" or $niveauD=="Manager Solutions Digitals et Data 2ème - année alternance" ){
            $niveauDemande =2;
        }elseif ($niveauD=="Bachelor CSI - année alternance"){
            $niveauDemande =3;
        }
       //dd($niveauDemande);
        if($niveauDemande >= $niveauEtudiant){
            $this->addFlash('success', 'Votre niveau ne conviens pas a ce soutient');
            return $this->redirectToRoute('app_demande_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($form->isSubmitted() && $form->isValid()) {
          //  dd($soutien);
            $soutien->setDateUpdate(new \DateTime());
            $soutien->setStatus("0");
            //dd($soutien);
            $entityManager->persist($soutien);
            $entityManager->flush();

            return $this->redirectToRoute('app_soutien_index', [], Response::HTTP_SEE_OTHER);
            }



        return $this->render('soutien/new.html.twig', [
            'soutien' => $soutien,
            'form' => $form,
            'id'=>$id
        ]);
    }

    #[Route('/{id}', name: 'app_soutien_show', methods: ['GET'])]
    public function show(Soutien $soutien): Response
    {
        return $this->render('soutien/show.html.twig', [
            'soutien' => $soutien,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_soutien_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Soutien $soutien, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SoutienType::class, $soutien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_soutien_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('soutien/edit.html.twig', [
            'soutien' => $soutien,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_soutien_delete', methods: ['POST'])]
    public function delete(Request $request, Soutien $soutien, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$soutien->getId(), $request->request->get('_token'))) {
            $entityManager->remove($soutien);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_soutien_index', [], Response::HTTP_SEE_OTHER);
    }
}
