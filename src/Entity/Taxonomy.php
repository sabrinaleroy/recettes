<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaxonomyRepository")
 */
class Taxonomy
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
    private $value;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TaxonomyType", inversedBy="taxonomies")
     */
    private $type;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Recipe", mappedBy="taxonomy")
     */
    private $recipes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\MySay", mappedBy="taxonomy")
     */
    private $mySays;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->mySays = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getType(): ?TaxonomyType
    {
        return $this->type;
    }

    public function setType(?TaxonomyType $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Recipe[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipe $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->addTaxonomy($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            $recipe->removeTaxonomy($this);
        }

        return $this;
    }

    /**
     * @return Collection|MySay[]
     */
    public function getMySays(): Collection
    {
        return $this->mySays;
    }

    public function addMySay(MySay $mySay): self
    {
        if (!$this->mySays->contains($mySay)) {
            $this->mySays[] = $mySay;
            $mySay->addTaxonomy($this);
        }

        return $this;
    }

    public function removeMySay(MySay $mySay): self
    {
        if ($this->mySays->contains($mySay)) {
            $this->mySays->removeElement($mySay);
            $mySay->removeTaxonomy($this);
        }

        return $this;
    }
}
