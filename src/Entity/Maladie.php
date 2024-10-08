<?php

namespace App\Entity;

use App\Repository\MaladieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaladieRepository::class)]
class Maladie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    /**
     * @var Collection<int, PatientMaladie>
     */
    #[ORM\OneToMany(targetEntity: PatientMaladie::class, mappedBy: 'maladie')]
    private Collection $patientMaladies;

    /**
     * @var Collection<int, Exercice>
     */
    #[ORM\ManyToMany(targetEntity: Exercice::class, mappedBy: 'maladie')]
    private Collection $exercices;

    public function __construct()
    {
        $this->patientMaladies = new ArrayCollection();
        $this->exercices = new ArrayCollection();
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

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, PatientMaladie>
     */
    public function getPatientMaladies(): Collection
    {
        return $this->patientMaladies;
    }

    public function addPatientMalady(PatientMaladie $patientMalady): static
    {
        if (!$this->patientMaladies->contains($patientMalady)) {
            $this->patientMaladies->add($patientMalady);
            $patientMalady->setMaladie($this);
        }

        return $this;
    }

    public function removePatientMalady(PatientMaladie $patientMalady): static
    {
        if ($this->patientMaladies->removeElement($patientMalady)) {
            // set the owning side to null (unless already changed)
            if ($patientMalady->getMaladie() === $this) {
                $patientMalady->setMaladie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getExercices(): Collection
    {
        return $this->exercices;
    }

    public function addExercice(Exercice $exercice): static
    {
        if (!$this->exercices->contains($exercice)) {
            $this->exercices->add($exercice);
            $exercice->addMaladie($this);
        }

        return $this;
    }

    public function removeExercice(Exercice $exercice): static
    {
        if ($this->exercices->removeElement($exercice)) {
            $exercice->removeMaladie($this);
        }

        return $this;
    }
}
