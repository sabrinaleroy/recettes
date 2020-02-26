<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MySayRepository")
 */
class MySay
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
    private $entity;

    /**
     * @ORM\Column(type="integer")
     */
    private $entityId;

    /**
     * @ORM\Column(type="blob", nullable=true)
     */
    private $text;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="mySays")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VoteMySay", mappedBy="mySay", orphanRemoval=true)
     */
    private $votes;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Taxonomy", inversedBy="mySays")
     */
    private $taxonomy;

    public function __construct()
    {
        $this->votes = new ArrayCollection();
        $this->taxonomy = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntity(): ?string
    {
        return $this->entity;
    }

    public function setEntity(string $entity): self
    {
        $this->entity = $entity;

        return $this;
    }

    public function getEntityId(): ?int
    {
        return $this->entityId;
    }

    public function setEntityId(int $entityId): self
    {
        $this->entityId = $entityId;

        return $this;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setText($text): self
    {
        $this->text = $text;

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
     * @return Collection|VoteMySay[]
     */
    public function getVotes(): Collection
    {
        return $this->votes;
    }

    public function addVote(VoteMySay $vote): self
    {
        if (!$this->votes->contains($vote)) {
            $this->votes[] = $vote;
            $vote->setMySay($this);
        }

        return $this;
    }

    public function removeVote(VoteMySay $vote): self
    {
        if ($this->votes->contains($vote)) {
            $this->votes->removeElement($vote);
            // set the owning side to null (unless already changed)
            if ($vote->getMySay() === $this) {
                $vote->setMySay(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Taxonomy[]
     */
    public function getTaxonomy(): Collection
    {
        return $this->taxonomy;
    }

    public function addTaxonomy(Taxonomy $taxonomy): self
    {
        if (!$this->taxonomy->contains($taxonomy)) {
            $this->taxonomy[] = $taxonomy;
        }

        return $this;
    }

    public function removeTaxonomy(Taxonomy $taxonomy): self
    {
        if ($this->taxonomy->contains($taxonomy)) {
            $this->taxonomy->removeElement($taxonomy);
        }

        return $this;
    }
}
