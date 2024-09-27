<?php

namespace App\Entity;

use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
class Burger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    #[ORM\ManyToOne(inversedBy: 'burgers')]
    private ?Pain $Pain = null;

    /**
     * @var Collection<int, Oignon>
     */
    #[ORM\ManyToMany(targetEntity: Oignon::class, inversedBy: 'burgers')]
    private Collection $Oignon;

    /**
     * @var Collection<int, Sauce>
     */
    #[ORM\ManyToMany(targetEntity: Sauce::class, inversedBy: 'burgers')]
    private Collection $Sauce;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $Image = null;

    /**
     * @var Collection<int, Commentaire>
     */
    #[ORM\OneToMany(targetEntity: Commentaire::class, mappedBy: 'burger')]
    private Collection $Commentaire;

    public function __construct()
    {
        $this->Oignon = new ArrayCollection();
        $this->Sauce = new ArrayCollection();
        $this->Commentaire = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function getPain(): ?Pain
    {
        return $this->Pain;
    }

    public function setPain(?Pain $Pain): static
    {
        $this->Pain = $Pain;

        return $this;
    }

    /**
     * @return Collection<int, Oignon>
     */
    public function getOignon(): Collection
    {
        return $this->Oignon;
    }

    public function addOignon(Oignon $oignon): static
    {
        if (!$this->Oignon->contains($oignon)) {
            $this->Oignon->add($oignon);
        }

        return $this;
    }

    public function removeOignon(Oignon $oignon): static
    {
        $this->Oignon->removeElement($oignon);

        return $this;
    }

    /**
     * @return Collection<int, Sauce>
     */
    public function getSauce(): Collection
    {
        return $this->Sauce;
    }

    public function addSauce(Sauce $sauce): static
    {
        if (!$this->Sauce->contains($sauce)) {
            $this->Sauce->add($sauce);
        }

        return $this;
    }

    public function removeSauce(Sauce $sauce): static
    {
        $this->Sauce->removeElement($sauce);

        return $this;
    }

    public function getImage(): ?Image
    {
        return $this->Image;
    }

    public function setImage(?Image $Image): static
    {
        $this->Image = $Image;

        return $this;
    }

    /**
     * @return Collection<int, Commentaire>
     */
    public function getCommentaire(): Collection
    {
        return $this->Commentaire;
    }

    public function addCommentaire(Commentaire $commentaire): static
    {
        if (!$this->Commentaire->contains($commentaire)) {
            $this->Commentaire->add($commentaire);
            $commentaire->setBurger($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): static
    {
        if ($this->Commentaire->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getBurger() === $this) {
                $commentaire->setBurger(null);
            }
        }

        return $this;
    }
}
