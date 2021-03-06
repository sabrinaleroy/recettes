<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recipe", mappedBy="author")
     */
    private $recipes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\MySay", mappedBy="author", orphanRemoval=true)
     */
    private $mySays;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\VoteMySay", mappedBy="voting", orphanRemoval=true)
     */
    private $voteMySays;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ComNote", mappedBy="author", orphanRemoval=true)
     */
    private $comNotes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ShoppingList", mappedBy="author")
     */
    private $shoppingLists;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\ShoppingList", mappedBy="sharedWith")
     */
    private $sharedShoppingLists;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeList", mappedBy="author", orphanRemoval=true)
     */
    private $recipeLists;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Moderation", mappedBy="author")
     */
    private $moderations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Notification", mappedBy="target", orphanRemoval=true)
     */
    private $notifications;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="author")
     */
    private $images;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
        $this->mySays = new ArrayCollection();
        $this->voteMySays = new ArrayCollection();
        $this->comNotes = new ArrayCollection();
        $this->shoppingLists = new ArrayCollection();
        $this->sharedShoppingLists = new ArrayCollection();
        $this->recipeLists = new ArrayCollection();
        $this->moderations = new ArrayCollection();
        $this->notifications = new ArrayCollection();
        $this->images = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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
            $recipe->setAuthor($this);
        }

        return $this;
    }

    public function removeRecipe(Recipe $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            // set the owning side to null (unless already changed)
            if ($recipe->getAuthor() === $this) {
                $recipe->setAuthor(null);
            }
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
            $mySay->setAuthor($this);
        }

        return $this;
    }

    public function removeMySay(MySay $mySay): self
    {
        if ($this->mySays->contains($mySay)) {
            $this->mySays->removeElement($mySay);
            // set the owning side to null (unless already changed)
            if ($mySay->getAuthor() === $this) {
                $mySay->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|VoteMySay[]
     */
    public function getVoteMySays(): Collection
    {
        return $this->voteMySays;
    }

    public function addVoteMySay(VoteMySay $voteMySay): self
    {
        if (!$this->voteMySays->contains($voteMySay)) {
            $this->voteMySays[] = $voteMySay;
            $voteMySay->setVoting($this);
        }

        return $this;
    }

    public function removeVoteMySay(VoteMySay $voteMySay): self
    {
        if ($this->voteMySays->contains($voteMySay)) {
            $this->voteMySays->removeElement($voteMySay);
            // set the owning side to null (unless already changed)
            if ($voteMySay->getVoting() === $this) {
                $voteMySay->setVoting(null);
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
            $comNote->setAuthor($this);
        }

        return $this;
    }

    public function removeComNote(ComNote $comNote): self
    {
        if ($this->comNotes->contains($comNote)) {
            $this->comNotes->removeElement($comNote);
            // set the owning side to null (unless already changed)
            if ($comNote->getAuthor() === $this) {
                $comNote->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ShoppingList[]
     */
    public function getShoppingLists(): Collection
    {
        return $this->shoppingLists;
    }

    public function addShoppingList(ShoppingList $shoppingList): self
    {
        if (!$this->shoppingLists->contains($shoppingList)) {
            $this->shoppingLists[] = $shoppingList;
            $shoppingList->setAuthor($this);
        }

        return $this;
    }

    public function removeShoppingList(ShoppingList $shoppingList): self
    {
        if ($this->shoppingLists->contains($shoppingList)) {
            $this->shoppingLists->removeElement($shoppingList);
            // set the owning side to null (unless already changed)
            if ($shoppingList->getAuthor() === $this) {
                $shoppingList->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ShoppingList[]
     */
    public function getSharedShoppingLists(): Collection
    {
        return $this->sharedShoppingLists;
    }

    public function addSharedShoppingList(ShoppingList $sharedShoppingList): self
    {
        if (!$this->sharedShoppingLists->contains($sharedShoppingList)) {
            $this->sharedShoppingLists[] = $sharedShoppingList;
            $sharedShoppingList->addSharedWith($this);
        }

        return $this;
    }

    public function removeSharedShoppingList(ShoppingList $sharedShoppingList): self
    {
        if ($this->sharedShoppingLists->contains($sharedShoppingList)) {
            $this->sharedShoppingLists->removeElement($sharedShoppingList);
            $sharedShoppingList->removeSharedWith($this);
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
            $recipeList->setAuthor($this);
        }

        return $this;
    }

    public function removeRecipeList(RecipeList $recipeList): self
    {
        if ($this->recipeLists->contains($recipeList)) {
            $this->recipeLists->removeElement($recipeList);
            // set the owning side to null (unless already changed)
            if ($recipeList->getAuthor() === $this) {
                $recipeList->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Moderation[]
     */
    public function getModerations(): Collection
    {
        return $this->moderations;
    }

    public function addModeration(Moderation $moderation): self
    {
        if (!$this->moderations->contains($moderation)) {
            $this->moderations[] = $moderation;
            $moderation->setAuthor($this);
        }

        return $this;
    }

    public function removeModeration(Moderation $moderation): self
    {
        if ($this->moderations->contains($moderation)) {
            $this->moderations->removeElement($moderation);
            // set the owning side to null (unless already changed)
            if ($moderation->getAuthor() === $this) {
                $moderation->setAuthor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Notification[]
     */
    public function getNotifications(): Collection
    {
        return $this->notifications;
    }

    public function addNotification(Notification $notification): self
    {
        if (!$this->notifications->contains($notification)) {
            $this->notifications[] = $notification;
            $notification->setTarget($this);
        }

        return $this;
    }

    public function removeNotification(Notification $notification): self
    {
        if ($this->notifications->contains($notification)) {
            $this->notifications->removeElement($notification);
            // set the owning side to null (unless already changed)
            if ($notification->getTarget() === $this) {
                $notification->setTarget(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Image[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Image $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setAuthor($this);
        }

        return $this;
    }

    public function removeImage(Image $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getAuthor() === $this) {
                $image->setAuthor(null);
            }
        }

        return $this;
    }
}
