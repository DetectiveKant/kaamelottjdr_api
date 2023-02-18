<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EffectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EffectRepository::class)]
#[ApiResource]
class Effect
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $aoeType = null;

    #[ORM\Column(nullable: true)]
    private ?float $aoeWidth = null;

    #[ORM\Column(nullable: true)]
    private ?float $aoeHeight = null;

    #[ORM\Column(nullable: true)]
    private ?array $script = [];

    #[ORM\ManyToMany(targetEntity: Ability::class, mappedBy: 'effects')]
    private Collection $abilities;

    public function __construct()
    {
        $this->abilities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAoeType(): ?string
    {
        return $this->aoeType;
    }

    public function setAoeType(string $aoeType): self
    {
        $this->aoeType = $aoeType;

        return $this;
    }

    public function getAoeWidth(): ?float
    {
        return $this->aoeWidth;
    }

    public function setAoeWidth(?float $aoeWidth): self
    {
        $this->aoeWidth = $aoeWidth;

        return $this;
    }

    public function getAoeHeight(): ?float
    {
        return $this->aoeHeight;
    }

    public function setAoeHeight(?float $aoeHeight): self
    {
        $this->aoeHeight = $aoeHeight;

        return $this;
    }

    public function getScript(): ?array
    {
        return $this->script;
    }

    public function setScript(?array $script): self
    {
        $this->script = $script;

        return $this;
    }

    /**
     * @return Collection<int, Ability>
     */
    public function getAbilities(): Collection
    {
        return $this->abilities;
    }

    public function addAbility(Ability $ability): self
    {
        if (!$this->abilities->contains($ability)) {
            $this->abilities->add($ability);
            $ability->addEffect($this);
        }

        return $this;
    }

    public function removeAbility(Ability $ability): self
    {
        if ($this->abilities->removeElement($ability)) {
            $ability->removeEffect($this);
        }

        return $this;
    }
}
