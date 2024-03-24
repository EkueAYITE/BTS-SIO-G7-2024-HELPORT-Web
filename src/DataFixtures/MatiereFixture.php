<?php

namespace App\DataFixtures;

use App\Entity\Matiere;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class MatiereFixture extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        for ($i=0;$i<10;$i++){
            $matiere = new Matiere();
            $matiere->setDesignation("matiere".strval($i));
            $matiere->setCode($i);
            $sousMatieres="";
            for($j=0;$j<10;$j++){
                $sousMatieres = $sousMatieres."#".$matiere->getDesignation()."ss".strval($j);
            }
            $matiere->setSousMatiere($sousMatieres);


            $manager->persist($matiere);

        }
        // $product = new Product();


        $manager->flush();
    }

    public function getOrder()
    {
        return 2;
        // TODO: Implement getOrder() method.
    }
}
