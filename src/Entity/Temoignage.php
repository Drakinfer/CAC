<?php

namespace App\Entity;

use App\Repository\TemoignageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemoignageRepository::class)]
class Temoignage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 45)]
    private $name;

    #[ORM\Column(type: 'string', length: 45)]
    private $first_name;

    #[ORM\Column(type: 'string', length: 45)]
    private $Temoignagescol;

    #[ORM\ManyToOne(targetEntity: Services::class, inversedBy: 'temoignages')]
    private $Offres;

    #[ORM\OneToMany(mappedBy: 'Temoignage', targetEntity: ParagrapheTemoignage::class)]
    private $paragrapheTemoignages;

    public function __construct()
    {
        $this->paragrapheTemoignages = new ArrayCollection();
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

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
    }

    public function getTemoignagescol(): ?string
    {
        return $this->Temoignagescol;
    }

    public function setTemoignagescol(string $Temoignagescol): self
    {
        $this->Temoignagescol = $Temoignagescol;

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

    /**
     * @return Collection|ParagrapheTemoignage[]
     */
    public function getParagrapheTemoignages(): Collection
    {
        return $this->paragrapheTemoignages;
    }

    public function addParagrapheTemoignage(ParagrapheTemoignage $paragrapheTemoignage): self
    {
        if (!$this->paragrapheTemoignages->contains($paragrapheTemoignage)) {
            $this->paragrapheTemoignages[] = $paragrapheTemoignage;
            $paragrapheTemoignage->setTemoignage($this);
        }

        return $this;
    }

    public function removeParagrapheTemoignage(ParagrapheTemoignage $paragrapheTemoignage): self
    {
        if ($this->paragrapheTemoignages->removeElement($paragrapheTemoignage)) {
            // set the owning side to null (unless already changed)
            if ($paragrapheTemoignage->getTemoignage() === $this) {
                $paragrapheTemoignage->setTemoignage(null);
            }
        }

        return $this;
    }
}
