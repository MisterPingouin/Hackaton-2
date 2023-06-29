<?php

namespace App\Entity;

use App\Repository\PhoneRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PhoneRepository::class)]
class Phone
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $ram = null;

    #[ORM\Column(length: 255)]
    private ?string $stockage = null;

    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    #[ORM\Column(length: 7)]
    private ?string $prix = null;

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE)]
    private ?\DateTimeImmutable $entryDate = null;

    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $exitDate = null;

    #[ORM\ManyToOne(inversedBy: 'phone')]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'phone')]
    private ?Modele $modele = null;

    #[ORM\Column]
    private ?bool $isSold = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRam(): ?string
    {
        return $this->ram;
    }

    public function setRam(string $ram): self
    {
        $this->ram = $ram;

        return $this;
    }

    public function getStockage(): ?string
    {
        return $this->stockage;
    }

    public function setStockage(string $stockage): self
    {
        $this->stockage = $stockage;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }

    public function getPrix(): ?string
    {
        return $this->prix;
    }

    public function setPrix(string $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEntryDate(): ?\DateTimeImmutable
    {
        return $this->entryDate;
    }

    public function setEntryDate(\DateTimeImmutable $entryDate): self
    {
        $this->entryDate = $entryDate;

        return $this;
    }

    public function getExitDate(): ?\DateTimeImmutable
    {
        return $this->exitDate;
    }

    public function setExitDate(?\DateTimeImmutable $exitDate): self
    {
        $this->exitDate = $exitDate;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?Modele
    {
        return $this->modele;
    }

    public function setModele(?Modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function isIsSold(): ?bool
    {
        return $this->isSold;
    }

    public function setIsSold(bool $isSold): static
    {
        $this->isSold = $isSold;

        return $this;
    }
}
