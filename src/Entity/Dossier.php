<?php

namespace App\Entity;

use App\Repository\DossierRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DossierRepository::class)]
class Dossier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'dossier', targetEntity: Ressouce::class)]
    private Collection $ressouces;

    public function __construct()
    {
        $this->ressouces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Ressouce>
     */
    public function getRessouces(): Collection
    {
        return $this->ressouces;
    }

    public function addRessouce(Ressouce $ressouce): static
    {
        if (!$this->ressouces->contains($ressouce)) {
            $this->ressouces->add($ressouce);
            $ressouce->setDossierId($this);
        }

        return $this;
    }

    public function removeRessouce(Ressouce $ressouce): static
    {
        if ($this->ressouces->removeElement($ressouce)) {
            // set the owning side to null (unless already changed)
            if ($ressouce->getDossierId() === $this) {
                $ressouce->setDossierId(null);
            }
        }

        return $this;
    }
}
