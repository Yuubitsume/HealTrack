<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    /**
     * @var Collection<int, UserExercice>
     */
    #[ORM\OneToMany(targetEntity: UserExercice::class, mappedBy: 'exercice')]
    private Collection $userExercices;

    /**
     * @var Collection<int, Maladie>
     */
    #[ORM\ManyToMany(targetEntity: Maladie::class, inversedBy: 'exercices')]
    private Collection $maladie;

    public function __construct()
    {
        $this->userExercices = new ArrayCollection();
        $this->maladie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, UserExercice>
     */
    public function getUserExercices(): Collection
    {
        return $this->userExercices;
    }

    public function addUserExercice(UserExercice $userExercice): static
    {
        if (!$this->userExercices->contains($userExercice)) {
            $this->userExercices->add($userExercice);
            $userExercice->setExercice($this);
        }

        return $this;
    }

    public function removeUserExercice(UserExercice $userExercice): static
    {
        if ($this->userExercices->removeElement($userExercice)) {
            // set the owning side to null (unless already changed)
            if ($userExercice->getExercice() === $this) {
                $userExercice->setExercice(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Maladie>
     */
    public function getMaladie(): Collection
    {
        return $this->maladie;
    }

    public function addMaladie(Maladie $maladie): static
    {
        if (!$this->maladie->contains($maladie)) {
            $this->maladie->add($maladie);
        }

        return $this;
    }

    public function removeMaladie(Maladie $maladie): static
    {
        $this->maladie->removeElement($maladie);

        return $this;
    }
}
