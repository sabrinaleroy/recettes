<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstructionItemRepository")
 */
class InstructionItem
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Item", inversedBy="instructionItems")
     */
    private $item;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Instruction", inversedBy="instructionItems")
     * @ORM\JoinColumn(nullable=false)
     */
    private $instruction;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $quotient;

    public function __construct()
    {
        $this->item = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Item $item): self
    {
        if (!$this->item->contains($item)) {
            $this->item[] = $item;
        }

        return $this;
    }

    public function removeItem(Item $item): self
    {
        if ($this->item->contains($item)) {
            $this->item->removeElement($item);
        }

        return $this;
    }

    public function getInstruction(): ?Instruction
    {
        return $this->instruction;
    }

    public function setInstruction(?Instruction $instruction): self
    {
        $this->instruction = $instruction;

        return $this;
    }

    public function getQuotient(): ?float
    {
        return $this->quotient;
    }

    public function setQuotient(?float $quotient): self
    {
        $this->quotient = $quotient;

        return $this;
    }
}
