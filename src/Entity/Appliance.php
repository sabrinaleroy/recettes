<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplianceRepository")
 */
class Appliance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $icon;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeAppliance", mappedBy="Appliance", orphanRemoval=true)
     */
    private $recipeAppliances;

    public function __construct()
    {
        $this->recipeAppliances = new ArrayCollection();
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * @return Collection|RecipeAppliance[]
     */
    public function getRecipeAppliances(): Collection
    {
        return $this->recipeAppliances;
    }

    public function addRecipeAppliances(RecipeAppliance $recipeAppliances): self
    {
        if (!$this->recipeAppliances->contains($recipeAppliances)) {
            $this->recipeAppliances[] = $recipeAppliances;
            $recipeAppliances->setAppliance($this);
        }

        return $this;
    }

    public function removeRecipeAppliances(RecipeAppliance $recipeAppliances): self
    {
        if ($this->recipeAppliances->contains($recipeAppliances)) {
            $this->recipeAppliances->removeElement($recipeAppliances);
            // set the owning side to null (unless already changed)
            if ($recipeAppliances->getAppliance() === $this) {
                $recipeAppliances->setAppliance(null);
            }
        }

        return $this;
    }
}
