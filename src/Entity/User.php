<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $birthDay = null;

    #[ORM\Column(length: 255)]
    private ?string $sex = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $speciality = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column]
    private ?bool $status = null;

    #[ORM\Column(nullable: true)]
    private ?int $note = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $biography = null;

    /**
     * @var Collection<int, PatientMaladie>
     */
    #[ORM\OneToMany(targetEntity: PatientMaladie::class, mappedBy: 'user')]
    private Collection $patientMaladies;

    /**
     * @var Collection<int, UserExercice>
     */
    #[ORM\OneToMany(targetEntity: UserExercice::class, mappedBy: 'user')]
    private Collection $userExercices;

    public function __construct()
    {
        $this->patientMaladies = new ArrayCollection();
        $this->userExercices = new ArrayCollection();
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

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getBirthDay(): ?\DateTimeInterface
    {
        return $this->birthDay;
    }

    public function setBirthDay(?\DateTimeInterface $birthDay): static
    {
        $this->birthDay = $birthDay;

        return $this;
    }

    public function getSex(): ?string
    {
        return $this->sex;
    }

    public function setSex(string $sex): static
    {
        $this->sex = $sex;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(?string $speciality): static
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function isStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(?int $note): static
    {
        $this->note = $note;

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

    public function getBiography(): ?string
    {
        return $this->biography;
    }

    public function setBiography(?string $biography): static
    {
        $this->biography = $biography;

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
            $patientMalady->setUser($this);
        }

        return $this;
    }

    public function removePatientMalady(PatientMaladie $patientMalady): static
    {
        if ($this->patientMaladies->removeElement($patientMalady)) {
            // set the owning side to null (unless already changed)
            if ($patientMalady->getUser() === $this) {
                $patientMalady->setUser(null);
            }
        }

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
            $userExercice->setUser($this);
        }

        return $this;
    }

    public function removeUserExercice(UserExercice $userExercice): static
    {
        if ($this->userExercices->removeElement($userExercice)) {
            // set the owning side to null (unless already changed)
            if ($userExercice->getUser() === $this) {
                $userExercice->setUser(null);
            }
        }

        return $this;
    }
}
