<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ItemRepository")
 */
class Item
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipe", inversedBy="items")
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="items")
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Unit")
     */
    private $unit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ProductState")
     */
    private $state;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $quantity;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\InstructionItem", mappedBy="item")
     */
    private $instructionItems;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\ShoppingList", inversedBy="items")
     */
    private $shoppingListId;

    public function __construct()
    {
        $this->instructionItems = new ArrayCollection();
    }

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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getUnit(): ?Unit
    {
        return $this->unit;
    }

    public function setUnit(?Unit $unit): self
    {
        $this->unit = $unit;

        return $this;
    }

    public function getState(): ?ProductState
    {
        return $this->state;
    }

    public function setState(?ProductState $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getQuantity(): ?float
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return Collection|InstructionItem[]
     */
    public function getInstructionItems(): Collection
    {
        return $this->instructionItems;
    }

    public function addInstructionItem(InstructionItem $instructionItem): self
    {
        if (!$this->instructionItems->contains($instructionItem)) {
            $this->instructionItems[] = $instructionItem;
            $instructionItem->addItem($this);
        }

        return $this;
    }

    public function removeInstructionItem(InstructionItem $instructionItem): self
    {
        if ($this->instructionItems->contains($instructionItem)) {
            $this->instructionItems->removeElement($instructionItem);
            $instructionItem->removeItem($this);
        }

        return $this;
    }

    public function getShoppingListId(): ?ShoppingList
    {
        return $this->shoppingListId;
    }

    public function setShoppingListId(?ShoppingList $shoppingListId): self
    {
        $this->shoppingListId = $shoppingListId;

        return $this;
    }
}
