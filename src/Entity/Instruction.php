<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InstructionRepository")
 */
class Instruction
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $sort;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Appliance")
     */
    private $appliances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\InstructionItem", mappedBy="instruction", orphanRemoval=true)
     */
    private $instructionItems;

    public function __construct()
    {
        $this->appliances = new ArrayCollection();
        $this->instructionItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getSort(): ?int
    {
        return $this->sort;
    }

    public function setSort(?int $sort): self
    {
        $this->sort = $sort;

        return $this;
    }

    /**
     * @return Collection|Appliance[]
     */
    public function getAppliances(): Collection
    {
        return $this->appliances;
    }

    public function addAppliance(Appliance $appliance): self
    {
        if (!$this->appliances->contains($appliance)) {
            $this->appliances[] = $appliance;
        }

        return $this;
    }

    public function removeAppliance(Appliance $appliance): self
    {
        if ($this->appliances->contains($appliance)) {
            $this->appliances->removeElement($appliance);
        }

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
            $instructionItem->setInstruction($this);
        }

        return $this;
    }

    public function removeInstructionItem(InstructionItem $instructionItem): self
    {
        if ($this->instructionItems->contains($instructionItem)) {
            $this->instructionItems->removeElement($instructionItem);
            // set the owning side to null (unless already changed)
            if ($instructionItem->getInstruction() === $this) {
                $instructionItem->setInstruction(null);
            }
        }

        return $this;
    }
}
