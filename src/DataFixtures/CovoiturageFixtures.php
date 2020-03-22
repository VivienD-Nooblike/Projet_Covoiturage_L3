<?php
namespace App\DataFixtures;

use App\Entity\Covoiturage;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CovoiturageFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $Covoiturage1 = new Covoiturage();
        $Covoiturage1->setTrajet($manager->merge($this->getReference('Trajet-Nantes-Paris')))
        ->addConducteur($manager->merge($this->getReference('Utilisateur-1')))
        ->setDateDepart(new \DateTime('2020-03-25 10:30'))
        ->setDateArrivee(new \DateTime('2020-03-25 12:30'))
        ->setDescription('Trajet de Nantes vers Paris')
        ->setPassager(array('Utilisateur-3'))
        ->setNbPlace(2)
        ->setPrix(15)
        ->setDisponibilite(true)
        ->setDateExpiration(new \DateTime('+15 days'));

        $manager->persist($Covoiturage1);


        $Covoiturage2 = new Covoiturage();
        $Covoiturage2->setTrajet($manager->merge($this->getReference('Trajet-Paris-Nantes')))
        ->addConducteur($manager->merge($this->getReference('Utilisateur-2')))
        ->setDateDepart(new \DateTime('2020-03-27 18:00'))
        ->setDateArrivee(new \DateTime('2020-03-27 20:00'))
        ->setDescription('Trajet de Paris vers Nantes')
        ->setNbPlace(1)
        ->setPrix(10)
        ->setDisponibilite(true)
        ->setDateExpiration(new \DateTime('+15 days'));

        $manager->persist($Covoiturage2);


        $Covoiturage3 = new Covoiturage();
        $Covoiturage3->setTrajet($manager->merge($this->getReference('Trajet-Bordeaux-Toulouse')))
            ->addConducteur($manager->merge($this->getReference('Utilisateur-3')))
            ->setDateDepart(new \DateTime('2020-03-26 16:00'))
            ->setDateArrivee(new \DateTime('2020-03-26 18:30'))
            ->setDescription('Trajet de Bordeaux vers Toulouse')
            ->setNbPlace(5)
            ->setPassager(array('Utilisateur-1','Utilisateur-2'))
            ->setPrix(22)
            ->setDisponibilite(true)
            ->setDateExpiration(new \DateTime('+15 days'));

        $manager->persist($Covoiturage3);


        $Covoiturage4 = new Covoiturage();
        $Covoiturage4->setTrajet($manager->merge($this->getReference('Trajet-Toulouse-Bordeaux')))
            ->addConducteur($manager->merge($this->getReference('Utilisateur-4')))
            ->setDateDepart(new \DateTime('2020-04-01 09:00'))
            ->setDateArrivee(new \DateTime('2020-04-01 11:30'))
            ->setDescription("Trajet de Toulouse vers Bordeaux")
            ->setNbPlace(3)
            ->setPrix(18)
            ->setDisponibilite(true)
            ->setDateExpiration(new \DateTime('+15 days'));

        $manager->persist($Covoiturage4);


        $Covoiturage5 = new Covoiturage();
        $Covoiturage5->setTrajet($manager->merge($this->getReference('Trajet-Nantes-Paris')))
        ->addConducteur($manager->merge($this->getReference('Utilisateur-1')))
        ->setDateDepart(new \DateTime('2020-03-10 10:30'))
        ->setDateArrivee(new \DateTime('2020-03-10 12:30'))
        ->setDescription('Trajet de Nantes vers Paris')
        ->setNbPlace(2)
        ->setPrix(15)
        ->setDisponibilite(true)
        ->setDateExpiration(new \DateTime('-15 days'));

        $manager->persist($Covoiturage5);

        $manager->flush();
    }

    /**
     * @return array
     */
    public function getDependencies(): array
    {
        return [
            TrajetFixtures::class,
            UtilisateurFixtures::class,
        ];
    }
}
