<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_PORT => "9042",
            CURLOPT_URL => "http://localhost:9042/dataset/etudiants",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_POSTFIELDS => "",
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            $jsonData = json_decode($response, true);

            if ($jsonData !== null) {

                foreach ($jsonData as $etudiant)
                {
                    $user = new User();

                    if ($etudiant['sexe'] == 'M')
                    {
                        $user ->setSexe(1);
                    }

            $manager->persist($etudiant);
        }

        $manager->flush();
    }
}
