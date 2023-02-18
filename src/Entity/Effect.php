<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\EffectRepository;
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
}
