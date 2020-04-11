<?php
namespace App\DataFixtures;

use App\Entity\Trajet;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class TrajetFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     *
     * @return void
     */
    public function load(ObjectManager $manager) : void
    {
        $NantesTrajet = new Trajet();
        $NantesTrajet->setItineraire('Nantes-Paris');
        $NantesTrajet->setDepart('Nantes');
        $NantesTrajet->setDestination('Paris');
        $NantesTrajet->setAdresseDepart("2 Chemin de la Houssinière 44300 Nantes");
        $NantesTrajet->setAdresseArrivee("Champ de Mars 5 Avenue Anatole France, 75007 Paris");


        $ParisTrajet = new Trajet();
        $ParisTrajet->setItineraire('Paris-Nantes');
        $ParisTrajet->setDepart('Paris');
        $ParisTrajet->setDestination('Nantes');
        $ParisTrajet->setAdresseDepart("Champ de Mars 5 Avenue Anatole France, 75007 Paris");
        $ParisTrajet->setAdresseArrivee("2 Chemin de la Houssinière 44300 Nantes");

        $BordeauxTrajet = new Trajet();
        $BordeauxTrajet->setItineraire('Bordeaux-Toulouse');
        $BordeauxTrajet->setDepart('Bordeaux');
        $BordeauxTrajet->setDestination('Toulouse');
        $BordeauxTrajet->setAdresseDepart("Place de la Bourse 33000 Bordeaux");
        $BordeauxTrajet->setAdresseArrivee("Place du Capitole 31000 Toulouse");

        $ToulouseTrajet = new Trajet();
        $ToulouseTrajet->setItineraire('Toulouse-Bordeaux');
        $ToulouseTrajet->setDestination('Toulouse');
        $ToulouseTrajet->setDepart('Bordeaux');
        $ToulouseTrajet->setAdresseDepart("Place du Capitole 31000 Toulouse");
        $ToulouseTrajet->setAdresseArrivee("Place de la Bourse 33000 Bordeaux");

        $manager->persist($NantesTrajet);
        $manager->persist($ParisTrajet);
        $manager->persist($BordeauxTrajet);
        $manager->persist($ToulouseTrajet);

        $manager->flush();

        $this->addReference('Trajet-Nantes-Paris', $NantesTrajet);
        $this->addReference('Trajet-Paris-Nantes', $ParisTrajet);
        $this->addReference('Trajet-Bordeaux-Toulouse', $BordeauxTrajet);
        $this->addReference('Trajet-Toulouse-Bordeaux', $ToulouseTrajet);

    }
}
