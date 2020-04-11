<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrajetRepository")
 */
class Trajet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $itineraire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $destination;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_depart;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse_arrivee;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $temps_trajet;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Covoiturage", mappedBy="trajet")
     */
    private $covoiturages;

    public function __construct()
    {
        $this->covoiturages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getItineraire(): ?string
    {
        return $this->itineraire;
    }

    public function setItineraire(string $itineraire): self
    {
        $this->itineraire = $itineraire;

        return $this;
    }

    public function getDepart(): ?string
    {
        return $this->depart;
    }

    public function setDepart(string $depart): self
    {
        $this->depart = $depart;

        return $this;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): self
    {
        $this->destination = $destination;

        return $this;
    }

    public function getAdresseDepart(): ?string
    {
        return $this->adresse_depart;
    }

    public function setAdresseDepart(string $adresse_depart): self
    {
        $this->adresse_depart = $adresse_depart;

        return $this;
    }

    public function getAdresseArrivee(): ?string
    {
        return $this->adresse_arrivee;
    }

    public function setAdresseArrivee(string $adresse_arrivee): self
    {
        $this->adresse_arrivee = $adresse_arrivee;

        return $this;
    }

    public function getTempsTrajet(): ?\DateTimeInterface
    {
        return $this->temps_trajet;
    }

    public function setTempsTrajet(?\DateTimeInterface $temps_trajet): self
    {
        $this->temps_trajet = $temps_trajet;

        return $this;
    }

    /**
     * @return Collection|Covoiturage[]
     */
    public function getCovoiturages(): Collection
    {
        return $this->covoiturages;
    }

    public function getCovoituragesNonExpires(): Collection
    {
        return $this->covoiturages;
    }

    public function addCovoiturages(Covoiturage $covoiturage): self
    {
        if (!$this->covoiturages->contains($covoiturage)) {
            $this->covoiturages[] = $covoiturage;
            $covoiturage->setTrajet($this);
        }

        return $this;
    }

    public function removeCovoiturage(Covoiturage $covoiturage): self
    {
        if ($this->covoiturages
            ->contains($covoiturage)) {
            $this->covoiturages->removeElement($covoiturage);
            // set the owning side to null (unless already changed)
            if ($covoiturage->getTrajet() === $this) {
                $covoiturage->setTrajet(null);
            }
        }

        return $this;
    }
}
