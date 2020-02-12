<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeApplianceRepository")
 */
class RecipeAppliance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipe", inversedBy="recipeAppliances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Appliance", inversedBy="recipeAppliances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $appliance;

    /**
     * @ORM\Column(type="boolean")
     */
    private $mandatory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getAppliance(): ?Appliance
    {
        return $this->appliance;
    }

    public function setAppliance(?Appliance $appliance): self
    {
        $this->appliance = $appliance;

        return $this;
    }

    public function getMandatory(): ?bool
    {
        return $this->mandatory;
    }

    public function setMandatory(bool $mandatory): self
    {
        $this->mandatory = $mandatory;

        return $this;
    }
}
