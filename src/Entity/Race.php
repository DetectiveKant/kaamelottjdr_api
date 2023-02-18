<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaceRepository::class)]
#[ApiResource]
class Race
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'race', targetEntity: RaceAbility::class, orphanRemoval: true)]
    private Collection $raceAbilities;

    public function __construct()
    {
        $this->raceAbilities = new ArrayCollection();
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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, RaceAbility>
     */
    public function getRaceAbilities(): Collection
    {
        return $this->raceAbilities;
    }

    public function addRaceAbility(RaceAbility $raceAbility): self
    {
        if (!$this->raceAbilities->contains($raceAbility)) {
            $this->raceAbilities->add($raceAbility);
            $raceAbility->setRace($this);
        }

        return $this;
    }

    public function removeRaceAbility(RaceAbility $raceAbility): self
    {
        if ($this->raceAbilities->removeElement($raceAbility)) {
            // set the owning side to null (unless already changed)
            if ($raceAbility->getRace() === $this) {
                $raceAbility->setRace(null);
            }
        }

        return $this;
    }
}
