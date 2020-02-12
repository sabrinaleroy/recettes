<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VoteMySayRepository")
 */
class VoteMySay
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MySay", inversedBy="votes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $mySay;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="voteMySays")
     * @ORM\JoinColumn(nullable=false)
     */
    private $voting;

    /**
     * @ORM\Column(type="boolean")
     */
    private $value;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMySay(): ?MySay
    {
        return $this->mySay;
    }

    public function setMySay(?MySay $mySay): self
    {
        $this->mySay = $mySay;

        return $this;
    }

    public function getVoting(): ?User
    {
        return $this->voting;
    }

    public function setVoting(?User $voting): self
    {
        $this->voting = $voting;

        return $this;
    }

    public function getValue(): ?bool
    {
        return $this->value;
    }

    public function setValue(bool $value): self
    {
        $this->value = $value;

        return $this;
    }
}
