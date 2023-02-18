<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AbilityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AbilityRepository::class)]
#[ApiResource]
class Ability
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 1023)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $actionType = null;

    #[ORM\Column(nullable: true)]
    private ?int $actionCount = null;

    #[ORM\Column(nullable: true)]
    private ?float $range = null;

    #[ORM\ManyToMany(targetEntity: Effect::class, inversedBy: 'abilities')]
    private Collection $effects;

    #[ORM\OneToMany(mappedBy: 'ability', targetEntity: AbilityResource::class, orphanRemoval: true)]
    private Collection $abilityResources;

    public function __construct()
    {
        $this->effects = new ArrayCollection();
        $this->abilityResources = new ArrayCollection();
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

    public function getActionType(): ?string
    {
        return $this->actionType;
    }

    public function setActionType(?string $actionType): self
    {
        $this->actionType = $actionType;

        return $this;
    }

    public function getActionCount(): ?int
    {
        return $this->actionCount;
    }

    public function setActionCount(?int $actionCount): self
    {
        $this->actionCount = $actionCount;

        return $this;
    }

    public function getRange(): ?float
    {
        return $this->range;
    }

    public function setRange(?float $range): self
    {
        $this->range = $range;

        return $this;
    }

    /**
     * @return Collection<int, Effect>
     */
    public function getEffects(): Collection
    {
        return $this->effects;
    }

    public function addEffect(Effect $effect): self
    {
        if (!$this->effects->contains($effect)) {
            $this->effects->add($effect);
        }

        return $this;
    }

    public function removeEffect(Effect $effect): self
    {
        $this->effects->removeElement($effect);

        return $this;
    }

    /**
     * @return Collection<int, AbilityResource>
     */
    public function getAbilityResources(): Collection
    {
        return $this->abilityResources;
    }

    public function addAbilityResource(AbilityResource $abilityResource): self
    {
        if (!$this->abilityResources->contains($abilityResource)) {
            $this->abilityResources->add($abilityResource);
            $abilityResource->setAbility($this);
        }

        return $this;
    }

    public function removeAbilityResource(AbilityResource $abilityResource): self
    {
        if ($this->abilityResources->removeElement($abilityResource)) {
            // set the owning side to null (unless already changed)
            if ($abilityResource->getAbility() === $this) {
                $abilityResource->setAbility(null);
            }
        }

        return $this;
    }
}
