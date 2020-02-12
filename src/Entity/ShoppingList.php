<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ShoppingListRepository")
 */
class ShoppingList
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="shoppingLists")
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedDate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="sharedShoppingLists")
     */
    private $sharedWith;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Item", mappedBy="shoppingListId")
     */
    private $items;

    public function __construct()
    {
        $this->sharedWith = new ArrayCollection();
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUpdatedDate(): ?\DateTimeInterface
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(?\DateTimeInterface $updatedDate): self
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getSharedWith(): Collection
    {
        return $this->sharedWith;
    }

    public function addSharedWith(User $sharedWith): self
    {
        if (!$this->sharedWith->contains($sharedWith)) {
            $this->sharedWith[] = $sharedWith;
        }

        return $this;
    }

    public function removeSharedWith(User $sharedWith): self
    {
        if ($this->sharedWith->contains($sharedWith)) {
            $this->sharedWith->removeElement($sharedWith);
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
            $item->setShoppingListId($this);
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->items->contains($item)) {
            $this->items->removeElement($item);
            // set the owning side to null (unless already changed)
            if ($item->getShoppingListId() === $this) {
                $item->setShoppingListId(null);
            }
        }

        return $this;
    }
}
