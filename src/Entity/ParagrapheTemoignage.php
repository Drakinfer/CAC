<?php

namespace App\Entity;

use App\Repository\ParagrapheTemoignageRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParagrapheTemoignageRepository::class)]
class ParagrapheTemoignage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $paragraphe;

    #[ORM\ManyToOne(targetEntity: Temoignage::class, inversedBy: 'paragrapheTemoignages')]
    private $Temoignage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getParagraphe(): ?string
    {
        return $this->paragraphe;
    }

    public function setParagraphe(string $paragraphe): self
    {
        $this->paragraphe = $paragraphe;

        return $this;
    }

    public function getTemoignage(): ?Temoignage
    {
        return $this->Temoignage;
    }

    public function setTemoignage(?Temoignage $Temoignage): self
    {
        $this->Temoignage = $Temoignage;

        return $this;
    }
}
