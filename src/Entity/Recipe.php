<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeRepository")
 */
class Recipe
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
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $prepTime;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cookingTime;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="recipes")
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeAppliance", mappedBy="recipe", orphanRemoval=true)
     */
    private $recipeAppliances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="recipe")
     */
    private $items;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ComNote", mappedBy="recipe", orphanRemoval=true)
     */
    private $comNotes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\RecipeList", mappedBy="recipes")
     */
    private $recipeLists;

    public function __construct()
    {
        $this->recipeAppliances = new ArrayCollection();
        $this->items = new ArrayCollection();
        $this->comNotes = new ArrayCollection();
        $this->recipeLists = new ArrayCollection();
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

    public function getPrepTime(): ?int
    {
        return $this->prepTime;
    }

    public function setPrepTime(?int $prepTime): self
    {
        $this->prepTime = $prepTime;

        return $this;
    }

    public function getCookingTime(): ?int
    {
        return $this->cookingTime;
    }

    public function setCookingTime(?int $cookingTime): self
    {
        $this->cookingTime = $cookingTime;

        return $this;
    }

    public function getCreateDate(): ?\DateTimeInterface
    {
        return $this->createDate;
    }

    public function setCreateDate(\DateTimeInterface $createDate): self
    {
        $this->createDate = $createDate;

        return $this;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection|RecipeAppliance[]
     */
    public function getRecipeAppliances(): Collection
    {
        return $this->recipeAppliances;
    }

    public function addRecipeAppliance(RecipeAppliance $recipeAppliance): self
    {
        if (!$this->recipeAppliances->contains($recipeAppliance)) {
            $this->recipeAppliances[] = $recipeAppliance;
            $recipeAppliance->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeAppliance(RecipeAppliance $recipeAppliance): self
    {
        if ($this->recipeAppliances->contains($recipeAppliance)) {
            $this->recipeAppliances->removeElement($recipeAppliance);
            // set the owning side to null (unless already changed)
            if ($recipeAppliance->getRecipe() === $this) {
                $recipeAppliance->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): self
    {
        if (!$this->items->contains($item)) {
            $this->items[] = $item;
            $item->setRecipe($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getRecipe() === $this) {
                $item->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ComNote[]
     */
    public function getComNotes(): Collection
    {
        return $this->comNotes;
    }

    public function addComNote(ComNote $comNote): self
    {
        if (!$this->comNotes->contains($comNote)) {
            $this->comNotes[] = $comNote;
            $comNote->setRecipe($this);
        }

        return $this;
    }

    public function removeComNote(ComNote $comNote): self
    {
        if ($this->comNotes->contains($comNote)) {
            $this->comNotes->removeElement($comNote);
            // set the owning side to null (unless already changed)
            if ($comNote->getRecipe() === $this) {
                $comNote->setRecipe(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RecipeList[]
     */
    public function getRecipeLists(): Collection
    {
        return $this->recipeLists;
    }

    public function addRecipeList(RecipeList $recipeList): self
    {
        if (!$this->recipeLists->contains($recipeList)) {
            $this->recipeLists[] = $recipeList;
            $recipeList->addRecipe($this);
        }

        return $this;
    }

    public function removeRecipeList(RecipeList $recipeList): self
    {
        if ($this->recipeLists->contains($recipeList)) {
            $this->recipeLists->removeElement($recipeList);
            $recipeList->removeRecipe($this);
        }

        return $this;
    }
}
