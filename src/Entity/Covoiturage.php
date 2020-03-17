<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CovoiturageRepository")
 */
class Covoiturage
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $trajet;

    /**
     * @ORM\Column(type="integer")
     */
    private $conducteur;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $passager = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $nb_place;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\Column(type="boolean")
     */
    private $disponibilite;

    /**
     * @ORM\Column(type="date")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="date")
     */
    private $date_modification;

    /**
     * @ORM\Column(type="date")
     */
    private $date_expiration;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrajet(): ?int
    {
        return $this->trajet;
    }

    public function setTrajet(int $trajet): self
    {
        $this->trajet = $trajet;

        return $this;
    }

    public function getConducteur(): ?int
    {
        return $this->conducteur;
    }

    public function setConducteur(int $conducteur): self
    {
        $this->conducteur = $conducteur;

        return $this;
    }

    public function getPassager(): ?array
    {
        return $this->passager;
    }

    public function setPassager(?array $passager): self
    {
        $this->passager = $passager;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->nb_place;
    }

    public function setNbPlace(int $nb_place): self
    {
        $this->nb_place = $nb_place;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getDisponibilite(): ?bool
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(bool $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->date_modification;
    }

    public function setDateModification(\DateTimeInterface $date_modification): self
    {
        $this->date_modification = $date_modification;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->date_expiration;
    }

    public function setDateExpiration(\DateTimeInterface $date_expiration): self
    {
        $this->date_expiration = $date_expiration;

        return $this;
    }
}
