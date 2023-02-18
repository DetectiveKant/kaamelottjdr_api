<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\JobRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobRepository::class)]
#[ApiResource]
class Job
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: 'job', targetEntity: JobResource::class, orphanRemoval: true)]
    private Collection $jobResources;

    #[ORM\OneToMany(mappedBy: 'job', targetEntity: JobAbility::class, orphanRemoval: true)]
    private Collection $jobAbilities;

    public function __construct()
    {
        $this->jobResources = new ArrayCollection();
        $this->jobAbilities = new ArrayCollection();
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
            $jobResource->setJob($this);
        }

        return $this;
    }

    public function removeJobResource(JobResource $jobResource): self
    {
        if ($this->jobResources->removeElement($jobResource)) {
            // set the owning side to null (unless already changed)
            if ($jobResource->getJob() === $this) {
                $jobResource->setJob(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, JobAbility>
     */
    public function getJobAbilities(): Collection
    {
        return $this->jobAbilities;
    }

    public function addJobAbility(JobAbility $jobAbility): self
    {
        if (!$this->jobAbilities->contains($jobAbility)) {
            $this->jobAbilities->add($jobAbility);
            $jobAbility->setJob($this);
        }

        return $this;
    }

    public function removeJobAbility(JobAbility $jobAbility): self
    {
        if ($this->jobAbilities->removeElement($jobAbility)) {
            // set the owning side to null (unless already changed)
            if ($jobAbility->getJob() === $this) {
                $jobAbility->setJob(null);
            }
        }

        return $this;
    }
}
