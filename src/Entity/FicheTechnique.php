<?php

namespace App\Entity;

use App\Repository\FicheTechniqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheTechniqueRepository::class)]
class FicheTechnique
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ScreenSize = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $processeur = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $batterie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $poids = null;

    #[ORM\OneToOne(inversedBy: 'ficheTechnique', cascade: ['persist', 'remove'])]
    private ?modele $modele = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getScreenSize(): ?string
    {
        return $this->ScreenSize;
    }

    public function setScreenSize(?string $ScreenSize): self
    {
        $this->ScreenSize = $ScreenSize;

        return $this;
    }

    public function getProcesseur(): ?string
    {
        return $this->processeur;
    }

    public function setProcesseur(?string $processeur): self
    {
        $this->processeur = $processeur;

        return $this;
    }

    public function getBatterie(): ?string
    {
        return $this->batterie;
    }

    public function setBatterie(?string $batterie): self
    {
        $this->batterie = $batterie;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getPoids(): ?string
    {
        return $this->poids;
    }

    public function setPoids(?string $poids): self
    {
        $this->poids = $poids;

        return $this;
    }

    public function getModele(): ?modele
    {
        return $this->modele;
    }

    public function setModele(?modele $modele): self
    {
        $this->modele = $modele;

        return $this;
    }
}
