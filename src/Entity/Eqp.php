<?php

namespace App\Entity;

use App\Repository\EqpRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: EqpRepository::class)]
class Eqp
{
    const INT = 'intérieur';
    const EXT = 'extérieur';

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['eqp'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]

    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\ManyToMany(targetEntity: Gite::class, inversedBy: 'eqps')]
    private Collection $gite;

    #[Groups(['eqp'])]
    public function getText()
    {
        return $this->name;
    }

    public function __construct()
    {
        $this->gite = new ArrayCollection();
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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Gite>
     */
    public function getGite(): Collection
    {
        return $this->gite;
    }

    public function addGite(Gite $gite): self
    {
        if (!$this->gite->contains($gite)) {
            $this->gite->add($gite);
        }

        return $this;
    }

    public function removeGite(Gite $gite): self
    {
        $this->gite->removeElement($gite);

        return $this;
    }
}
