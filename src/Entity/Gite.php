<?php

namespace App\Entity;

use App\Repository\GiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GiteRepository::class)]
class Gite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 255)]
    private ?string $departement = null;

    #[ORM\Column(length: 255)]
    private ?string $region = null;

    #[ORM\Column]
    private ?int $surface = null;

    #[ORM\Column]
    private ?int $rooms = null;

    #[ORM\Column]
    private ?int $beds = null;

    #[ORM\Column]
    private ?bool $animalAllowed = null;

    #[ORM\Column(nullable: true)]
    private ?float $animalFee = null;

    #[ORM\Column]
    private ?float $greenPrice = null;

    #[ORM\Column(nullable: true)]
    private ?float $redPrice = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $startRed = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $endRed = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'gite', targetEntity: GiteService::class, cascade: ['persist'])]
    private Collection $giteServices;

    #[ORM\ManyToMany(targetEntity: EqpInt::class, mappedBy: 'gite')]
    private Collection $eqpInts;

    #[ORM\ManyToMany(targetEntity: EqpExt::class, mappedBy: 'gite')]
    private Collection $eqpExts;

    #[ORM\ManyToOne(inversedBy: 'gite')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'giteContact')]
    #[ORM\JoinColumn(nullable: true)]
    private ?User $contact = null;

    public function __construct()
    {
        $this->giteServices = new ArrayCollection();
        $this->eqpInts = new ArrayCollection();
        $this->eqpExts = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): self
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getSurface(): ?int
    {
        return $this->surface;
    }

    public function setSurface(int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getRooms(): ?int
    {
        return $this->rooms;
    }

    public function setRooms(int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    public function getBeds(): ?int
    {
        return $this->beds;
    }

    public function setBeds(int $beds): self
    {
        $this->beds = $beds;

        return $this;
    }

    public function isAnimalAllowed(): ?bool
    {
        return $this->animalAllowed;
    }

    public function setAnimalAllowed(bool $animalAllowed): self
    {
        $this->animalAllowed = $animalAllowed;

        return $this;
    }

    public function getAnimalFee(): ?float
    {
        return $this->animalFee;
    }

    public function setAnimalFee(?float $animalFee): self
    {
        $this->animalFee = $animalFee;

        return $this;
    }

    public function getGreenPrice(): ?float
    {
        return $this->greenPrice;
    }

    public function setGreenPrice(float $greenPrice): self
    {
        $this->greenPrice = $greenPrice;

        return $this;
    }

    public function getRedPrice(): ?float
    {
        return $this->redPrice;
    }

    public function setRedPrice(?float $redPrice): self
    {
        $this->redPrice = $redPrice;

        return $this;
    }

    public function getStartRed(): ?\DateTimeInterface
    {
        return $this->startRed;
    }

    public function setStartRed(\DateTimeInterface $startRed): self
    {
        $this->startRed = $startRed;

        return $this;
    }

    public function getEndRed(): ?\DateTimeInterface
    {
        return $this->endRed;
    }

    public function setEndRed(?\DateTimeInterface $endRed): self
    {
        $this->endRed = $endRed;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, GiteService>
     */
    public function getGiteServices(): Collection
    {
        return $this->giteServices;
    }

    public function addGiteService(GiteService $giteService): self
    {
        if (!$this->giteServices->contains($giteService)) {
            $this->giteServices->add($giteService);
            $giteService->setGite($this);
        }

        return $this;
    }

    public function removeGiteService(GiteService $giteService): self
    {
        if ($this->giteServices->removeElement($giteService)) {
            // set the owning side to null (unless already changed)
            if ($giteService->getGite() === $this) {
                $giteService->setGite(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EqpInt>
     */
    public function getEqpInts(): Collection
    {
        return $this->eqpInts;
    }

    public function addEqpInt(EqpInt $eqpInt): self
    {
        if (!$this->eqpInts->contains($eqpInt)) {
            $this->eqpInts->add($eqpInt);
            $eqpInt->addGite($this);
        }

        return $this;
    }

    public function removeEqpInt(EqpInt $eqpInt): self
    {
        if ($this->eqpInts->removeElement($eqpInt)) {
            $eqpInt->removeGite($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, EqpExt>
     */
    public function getEqpExts(): Collection
    {
        return $this->eqpExts;
    }

    public function addEqpExt(EqpExt $eqpExt): self
    {
        if (!$this->eqpExts->contains($eqpExt)) {
            $this->eqpExts->add($eqpExt);
            $eqpExt->addGite($this);
        }

        return $this;
    }

    public function removeEqpExt(EqpExt $eqpExt): self
    {
        if ($this->eqpExts->removeElement($eqpExt)) {
            $eqpExt->removeGite($this);
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getContact(): ?User
    {
        return $this->contact;
    }

    public function setContact(?User $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

   
}
