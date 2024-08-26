<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SpecialisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialisationRepository::class)]
#[ApiResource]
class Specialisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'specialisation', targetEntity: Talent::class)]
    private Collection $talent;

    public function __construct()
    {
        $this->talent = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Talent>
     */
    public function getTalent(): Collection
    {
        return $this->talent;
    }

    public function addTalent(Talent $talent): self
    {
        if (!$this->talent->contains($talent)) {
            $this->talent->add($talent);
            $talent->setSpecialisation($this);
        }

        return $this;
    }

    public function removeTalent(Talent $talent): self
    {
        if ($this->talent->removeElement($talent)) {
            // set the owning side to null (unless already changed)
            if ($talent->getSpecialisation() === $this) {
                $talent->setSpecialisation(null);
            }
        }

        return $this;
    }
}
