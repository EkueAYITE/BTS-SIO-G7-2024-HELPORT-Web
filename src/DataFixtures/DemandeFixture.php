<?php

namespace App\DataFixtures;

use App\Entity\Demande;
use App\Entity\Matiere;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

;

class DemandeFixture extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = \Faker\Factory::create('fr_FR');
        $userRepository = $manager->getRepository(User::class);
        $listeUser = $userRepository->findAll();
        $matiereRepository = $manager->getRepository(Matiere::class);
        $listeMatiere = $matiereRepository->findAll();
        $dateDuJour = new DateTime();
        for($i=0;$i<15;$i++){
            $userRand=rand(1,14);
            $matiereRand=rand(1,9);
            $sousMatiere="";
            $demande= new Demande();
            $demande->setIdMatiere($listeMatiere[$matiereRand]);
            $demande->setUser($listeUser[$userRand]);
            $demande->setDateUpdated($dateDuJour);
            $demande->setDateFinDemande($dateDuJour);
            $demande->setStatut(1);

            for($j=0;$j<$matiereRand;$j++) {
                $sousMatiere = $sousMatiere."#".$demande->getIdMatiere()->getDesignation() ."ss".strval($j);
            }
            $demande->setSousMatiere($sousMatiere);

            $manager->persist($demande);

        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
    public function getOrder()
    {
        return 3;
        // TODO: Implement getOrder() method.
    }
}