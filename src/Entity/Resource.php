<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ResourceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResourceRepository::class)]
#[ApiResource]
class Resource
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $rgbHexColor = null;

    #[ORM\OneToMany(mappedBy: 'resource', targetEntity: AbilityResource::class, orphanRemoval: true)]
    private Collection $abilityResources;

    #[ORM\OneToMany(mappedBy: 'Resource', targetEntity: JobResource::class)]
    private Collection $jobResources;

    public function __construct()
    {
        $this->abilityResources = new ArrayCollection();
        $this->jobResources = new ArrayCollection();
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

    public function getRgbHexColor(): ?string
    {
        return $this->rgbHexColor;
    }

    public function setRgbHexColor(string $rgbHexColor): self
    {
        $this->rgbHexColor = $rgbHexColor;

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
            $abilityResource->setResource($this);
        }

        return $this;
    }

    public function removeAbilityResource(AbilityResource $abilityResource): self
    {
        if ($this->abilityResources->removeElement($abilityResource)) {
            // set the owning side to null (unless already changed)
            if ($abilityResource->getResource() === $this) {
                $abilityResource->setResource(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, JobResource>
     */
    public function getJobResources(): Collection
    {
        return $this->jobResources;
    }

    public function addJobResource(JobResource $jobResource): self
    {
        if (!$this->jobResources->contains($jobResource)) {
            $this->jobResources->add($jobResource);
            $jobResource->setResource($this);
        }

        return $this;
    }

    public function removeJobResource(JobResource $jobResource): self
    {
        if ($this->jobResources->removeElement($jobResource)) {
            // set the owning side to null (unless already changed)
            if ($jobResource->getResource() === $this) {
                $jobResource->setResource(null);
            }
        }

        return $this;
    }
}
