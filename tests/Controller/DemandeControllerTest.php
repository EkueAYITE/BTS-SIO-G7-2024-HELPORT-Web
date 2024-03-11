<?php

namespace App\Test\Controller;

use App\Entity\Demande;
use App\Repository\DemandeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DemandeControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private DemandeRepository $repository;
    private string $path = '/demande/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Demande::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Demande index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'demande[date_uptaded]' => 'Testing',
            'demande[date_fin_demande]' => 'Testing',
            'demande[statut]' => 'Testing',
            'demande[soutien]' => 'Testing',
            'demande[id_matiere]' => 'Testing',
        ]);

        self::assertResponseRedirects('/demande/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Demande();
        $fixture->setDate_uptaded('My Title');
        $fixture->setDate_fin_demande('My Title');
        $fixture->setStatut('My Title');
        $fixture->setSoutien('My Title');
        $fixture->setId_matiere('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Demande');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Demande();
        $fixture->setDate_uptaded('My Title');
        $fixture->setDate_fin_demande('My Title');
        $fixture->setStatut('My Title');
        $fixture->setSoutien('My Title');
        $fixture->setId_matiere('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'demande[date_uptaded]' => 'Something New',
            'demande[date_fin_demande]' => 'Something New',
            'demande[statut]' => 'Something New',
            'demande[soutien]' => 'Something New',
            'demande[id_matiere]' => 'Something New',
        ]);

        self::assertResponseRedirects('/demande/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getDate_uptaded());
        self::assertSame('Something New', $fixture[0]->getDate_fin_demande());
        self::assertSame('Something New', $fixture[0]->getStatut());
        self::assertSame('Something New', $fixture[0]->getSoutien());
        self::assertSame('Something New', $fixture[0]->getId_matiere());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Demande();
        $fixture->setDate_uptaded('My Title');
        $fixture->setDate_fin_demande('My Title');
        $fixture->setStatut('My Title');
        $fixture->setSoutien('My Title');
        $fixture->setId_matiere('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/demande/');
    }
}
