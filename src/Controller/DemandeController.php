<?php

namespace App\Controller;

use App\Entity\Demande;
use App\Form\DemandeType;

use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;

#[Route('/demande')]
class DemandeController extends AbstractController
{
    #[Route('/', name: 'app_demande_index', methods: ['GET'])]
    public function index(DemandeRepository $demandeRepository): Response
    {
        return $this->render('demande/index.html.twig', [
            'demandes' => $demandeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_demande_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $demande = new Demande();
        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $demande->setDateUpdated(new \DateTime());
            $demande->setStatut("0");
            $demande->setUser($this->getUser());
            $jsonData = $demande->getSousMatiere();
            $dataArray = json_decode($jsonData, true);

// Initialiser une chaîne pour stocker le résultat
            $resultString = '';

// Parcourir le tableau et concaténer les valeurs avec le format spécifié
            foreach ($dataArray as $item) {
                // Extraire la valeur de chaque élément du tableau
                $value = $item['value'];

                // Concaténer la valeur avec le format spécifié
                $resultString .= '#' . $value;
            }
            $demande->setSousMatiere($resultString);

            $entityManager->persist($demande);
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande/new.html.twig', [
            'demande' => $demande,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_demande_show', methods: ['GET'])]
    public function show(Demande $demande): Response
    {
        return $this->render('demande/show.html.twig', [
            'demande' => $demande,
        ]);
    }
    //todo : revoir la modification avec le JS pour qu'elle fonctionne corectement
    #[Route('/{id}/edit', name: 'app_demande_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Demande $demande, EntityManagerInterface $entityManager, DemandeRepository $demandeRepository): Response
    {

        $form = $this->createForm(DemandeType::class, $demande);
        $form->handleRequest($request);
        $sous_matiere = $demande->getSousMatiere();
        $sous_matiere= explode("#",$sous_matiere);
        array_filter($sous_matiere);
        json_encode($sous_matiere);
       // dd($sous_matiere);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_demande_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('demande/edit.html.twig', [
            'demande' => $demande,
            'form' => $form,
            'sous_matiere' => $sous_matiere
        ]);
    }

    #[Route('/{id}', name: 'app_demande_delete', methods: ['POST'])]
    public function delete(Request $request, Demande $demande, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$demande->getId(), $request->request->get('_token'))) {
            $entityManager->remove($demande);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_demande_index', [], Response::HTTP_SEE_OTHER);
    }
}
