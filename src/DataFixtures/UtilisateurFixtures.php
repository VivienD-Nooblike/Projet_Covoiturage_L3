<?php
namespace App\DataFixtures;

use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class UtilisateurFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $utilisateur1 = new Utilisateur();
        $utilisateur1->setNom("Pote")
            ->setPrenom("Pomme")
            ->setDateNaissance(new \DateTime("1997-05-19"))
            ->setTelephone("0123456789")
            ->setEmail("pommepote@gmail.com")
            ->setMotDePasse("compote");

        $utilisateur2 = new Utilisateur();
        $utilisateur2->setNom("Krem")
            ->setPrenom("Sociéte")
            ->setDateNaissance(new \DateTime("1967-01-24"))
            ->setTelephone("0693809820")
            ->setEmail("societekrem@gmail.com")
            ->setMotDePasse("fromage");

        $utilisateur3 = new Utilisateur();
        $utilisateur3->setNom("Whaouh")
            ->setPrenom("Crêpe")
            ->setDateNaissance(new \DateTime("1980-07-07"))
            ->setTelephone("0987654321")
            ->setEmail("crepewhaouh@gmail.com")
            ->setMotDePasse("whaouh");

        $utilisateur4 = new Utilisateur();
        $utilisateur4->setNom("Munch")
            ->setPrenom("Monster")
            ->setDateNaissance(new \DateTime("1983-05-05"))
            ->setTelephone("0982168231")
            ->setEmail("monstermunch@gmail.com")
            ->setMotDePasse("chips");


        $manager->persist($utilisateur1);
        $manager->persist($utilisateur2);
        $manager->persist($utilisateur3);
        $manager->persist($utilisateur4);

        $manager->flush();

        $this->addReference('Utilisateur-1', $utilisateur1);
        $this->addReference('Utilisateur-2', $utilisateur2);
        $this->addReference('Utilisateur-3', $utilisateur3);
        $this->addReference('Utilisateur-4', $utilisateur4);

    }
}
