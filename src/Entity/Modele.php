<?php

namespace App\Entity;

use App\Repository\ModeleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModeleRepository::class)]
class Modele
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'modeles')]
    private ?Marque $marque = null;

    #[ORM\OneToMany(mappedBy: 'modele', targetEntity: Phone::class)]
    private Collection $phone;

    #[ORM\OneToOne(mappedBy: 'modele', cascade: ['persist', 'remove'])]
    private ?FicheTechnique $ficheTechnique = null;

    public function __construct()
    {
        $this->phone = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection<int, Phone>
     */
    public function getPhone(): Collection
    {
        return $this->phone;
    }

    public function addPhone(Phone $phone): self
    {
        if (!$this->phone->contains($phone)) {
            $this->phone->add($phone);
            $phone->setModele($this);
        }

        return $this;
    }

    public function removePhone(Phone $phone): self
    {
        if ($this->phone->removeElement($phone)) {
            // set the owning side to null (unless already changed)
            if ($phone->getModele() === $this) {
                $phone->setModele(null);
            }
        }

        return $this;
    }

    public function getFicheTechnique(): ?FicheTechnique
    {
        return $this->ficheTechnique;
    }

    public function setFicheTechnique(?FicheTechnique $ficheTechnique): self
    {
        // unset the owning side of the relation if necessary
        if ($ficheTechnique === null && $this->ficheTechnique !== null) {
            $this->ficheTechnique->setModele(null);
        }

        // set the owning side of the relation if necessary
        if ($ficheTechnique !== null && $ficheTechnique->getModele() !== $this) {
            $ficheTechnique->setModele($this);
        }

        $this->ficheTechnique = $ficheTechnique;

        return $this;
    }
}
