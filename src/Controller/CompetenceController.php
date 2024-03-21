<?php

namespace App\Controller;

use App\Entity\Competence;
use App\Form\CompetenceType;
use App\Repository\CompetenceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/competence')]
class CompetenceController extends AbstractController
{
    #[Route('/', name: 'app_competence_index', methods: ['GET'])]
    public function index(CompetenceRepository $competenceRepository): Response
    {
        return $this->render('competence/index.html.twig', [
            'competences' => $competenceRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_competence_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $competence = new Competence();
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competence->addIdUser($this->getUser());
            $competence->setStatut(0);
             $jsonData = $competence->getSousMatiere();
             $dataArray = json_decode($jsonData,true);

            $resultString = '';
            foreach ($dataArray as $item) {
                // Extraire la valeur de chaque élément du tableau
                $value = $item['value'];

                // Concaténer la valeur avec le format spécifié
                $resultString .= '#' . $value;
            }
            $competence->setSousMatiere($resultString);
            $entityManager->persist($competence);
            $entityManager->flush();


            return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('competence/new.html.twig', [
            'competence' => $competence,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_competence_show', methods: ['GET'])]
    public function show(Competence $competence): Response
    {
        return $this->render('competence/show.html.twig', [
            'competence' => $competence,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_competence_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Competence $competence, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CompetenceType::class, $competence);
        $form->handleRequest($request);
        $sous_matiere = $competence->getSousMatiere();
        $sous_matiere= explode("#",$sous_matiere);
        array_filter($sous_matiere);
        json_encode($sous_matiere);

        if ($form->isSubmitted() && $form->isValid()) {
            $jsonData = $competence->getSousMatiere();
            $dataArray = json_decode($jsonData,true);

            // Initialiser une chaîne pour stocker le résultat
            $resultString = '';


            foreach ($dataArray as $item) {
                // Extraire la valeur de chaque élément du tableau
                $value = $item['value'];

                // Concaténer la valeur avec le format spécifié
                $resultString .= '#' . $value;
            }
            $competence->setSousMatiere($resultString);
            $entityManager->flush();

            return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('competence/edit.html.twig', [
            'competence' => $competence,
            'form' => $form,
            'sous_matiere'=>$sous_matiere
        ]);
    }

    #[Route('/{id}', name: 'app_competence_delete', methods: ['POST'])]
    public function delete(Request $request, Competence $competence, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$competence->getId(), $request->request->get('_token'))) {
            $entityManager->remove($competence);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_competence_index', [], Response::HTTP_SEE_OTHER);
    }
}
