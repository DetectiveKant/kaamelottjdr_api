<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RaceAbilityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RaceAbilityRepository::class)]
#[ApiResource]
class RaceAbility
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'raceAbilities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Race $race = null;

    #[ORM\ManyToOne(inversedBy: 'raceAbilities')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Ability $ability = null;

    #[ORM\Column]
    private ?int $level = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRace(): ?Race
    {
        return $this->race;
    }

    public function setRace(?Race $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getAbility(): ?Ability
    {
        return $this->ability;
    }

    public function setAbility(?Ability $ability): self
    {
        $this->ability = $ability;

        return $this;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): self
    {
        $this->level = $level;

        return $this;
    }
}
