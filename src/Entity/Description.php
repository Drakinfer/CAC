<?php

namespace App\Entity;

use App\Repository\DescriptionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DescriptionRepository::class)]
class Description
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $paragraph;

    #[ORM\Column(type: 'integer')]
    private $position;

    #[ORM\ManyToOne(targetEntity: Entreprise::class, inversedBy: 'descriptions')]
    #[ORM\JoinColumn(nullable: false)]
    private $entreprise;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $titre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParagraph(): ?string
    {
        return $this->paragraph;
    }

    public function setParagraph(string $paragraph): self
    {
        $this->paragraph = $paragraph;

        return $this;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(?string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }
}
