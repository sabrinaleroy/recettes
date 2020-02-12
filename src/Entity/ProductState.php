<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductStateRepository")
 */
class ProductState
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
    private $labelF;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $labelM;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabelF(): ?string
    {
        return $this->labelF;
    }

    public function setLabelF(?string $labelF): self
    {
        $this->labelF = $labelF;

        return $this;
    }

    public function getLabelM(): ?string
    {
        return $this->labelM;
    }

    public function setLabelM(?string $labelM): self
    {
        $this->labelM = $labelM;

        return $this;
    }
}
