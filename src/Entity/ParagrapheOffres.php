<?php

namespace App\Entity;

use App\Repository\ParagrapheOffresRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ParagrapheOffresRepository::class)]
class ParagrapheOffres
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'text')]
    private $message;

    #[ORM\ManyToOne(targetEntity: Services::class, inversedBy: 'paragrapheOffres')]
    private $Offres;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getOffres(): ?Services
    {
        return $this->Offres;
    }

    public function setOffres(?Services $Offres): self
    {
        $this->Offres = $Offres;

        return $this;
    }
}
