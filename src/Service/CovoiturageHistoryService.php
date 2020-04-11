<?php
namespace App\Service;

use App\Entity\Covoiturage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CovoiturageHistoryService
{
    private const MAX = 3;

    /** @var SessionInterface */
    private $session;

    /** @var EntityManagerInterface */
    private $em;

    /**
     * @param SessionInterface $session
     * @param EntityManagerInterface $em
     */
    public function __construct(SessionInterface $session, EntityManagerInterface $em)
    {
        $this->session = $session;
        $this->em = $em;
    }

    /**
     * @param Covoiturage $covoiturage
     *
     * @return void
     */
    public function addCovoiturage(Covoiturage $covoiturage) : void
    {

        $covoiturages = $this->getCovoituragesIds();

        // Ajoute l'identifiant d'un covoiturage au début du tableau
        array_unshift($covoiturages, $covoiturage->getId());
        dump($covoiturages);

        // supprimer les id. redondants
        $covoiturages = array_unique($covoiturages);

        // Garder uniquement 3 elements
        $covoiturages = array_slice($covoiturages, 0, self::MAX);
        // Sauvegarder les ids dans la session
        $this->session->set('covoiturage_history', $covoiturages);
    }

    /**
     * @return array
     */
    private function getCovoituragesIds() : array
    {
        return $this->session->get('covoiturage_history', []);
    }

    /**
     * @return Covoiturage[]
     */
    public function getCovoiturages() : array
    {
        $jobs = [];
        $jobRepository = $this->em->getRepository(Covoiturage::class);
        dump($this->getCovoituragesIds());
        foreach ($this->getCovoituragesIds() as $covoiturageId) {
            $jobs[] = $jobRepository->find($covoiturageId);
        }

        return array_filter($jobs);
    }
}
