<?php

namespace App\Entity;

use App\Repository\ServicesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicesRepository::class)]
class Services
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 45)]
    private $name;

    #[ORM\Column(type: 'integer')]
    private $position;

    #[ORM\ManyToOne(targetEntity: CategoriesServices::class, inversedBy: 'services')]
    private $CategoriesServices;

    #[ORM\OneToMany(mappedBy: 'Offres', targetEntity: ParagrapheOffres::class)]
    private $paragrapheOffres;

    #[ORM\OneToMany(mappedBy: 'Offres', targetEntity: LigneProgramme::class)]
    private $ligneProgrammes;

    #[ORM\OneToMany(mappedBy: 'Offres', targetEntity: Temoignage::class)]
    private $temoignages;

    #[ORM\ManyToOne(targetEntity: Type::class, inversedBy: 'services')]
    private $type;

    public function __construct()
    {
        $this->paragrapheOffres = new ArrayCollection();
        $this->ligneProgrammes = new ArrayCollection();
        $this->temoignages = new ArrayCollection();
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

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(int $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getCategoriesServices(): ?CategoriesServices
    {
        return $this->CategoriesServices;
    }

    public function setCategoriesServices(?CategoriesServices $CategoriesServices): self
    {
        $this->CategoriesServices = $CategoriesServices;

        return $this;
    }

    /**
     * @return Collection|ParagrapheOffres[]
     */
    public function getParagrapheOffres(): Collection
    {
        return $this->paragrapheOffres;
    }

    public function addParagrapheOffre(ParagrapheOffres $paragrapheOffre): self
    {
        if (!$this->paragrapheOffres->contains($paragrapheOffre)) {
            $this->paragrapheOffres[] = $paragrapheOffre;
            $paragrapheOffre->setOffres($this);
        }

        return $this;
    }

    public function removeParagrapheOffre(ParagrapheOffres $paragrapheOffre): self
    {
        if ($this->paragrapheOffres->removeElement($paragrapheOffre)) {
            // set the owning side to null (unless already changed)
            if ($paragrapheOffre->getOffres() === $this) {
                $paragrapheOffre->setOffres(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|LigneProgramme[]
     */
    public function getLigneProgrammes(): Collection
    {
        return $this->ligneProgrammes;
    }

    public function addLigneProgramme(LigneProgramme $ligneProgramme): self
    {
        if (!$this->ligneProgrammes->contains($ligneProgramme)) {
            $this->ligneProgrammes[] = $ligneProgramme;
            $ligneProgramme->setOffres($this);
        }

        return $this;
    }

    public function removeLigneProgramme(LigneProgramme $ligneProgramme): self
    {
        if ($this->ligneProgrammes->removeElement($ligneProgramme)) {
            // set the owning side to null (unless already changed)
            if ($ligneProgramme->getOffres() === $this) {
                $ligneProgramme->setOffres(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Temoignage[]
     */
    public function getTemoignages(): Collection
    {
        return $this->temoignages;
    }

    public function addTemoignage(Temoignage $temoignage): self
    {
        if (!$this->temoignages->contains($temoignage)) {
            $this->temoignages[] = $temoignage;
            $temoignage->setOffres($this);
        }

        return $this;
    }

    public function removeTemoignage(Temoignage $temoignage): self
    {
        if ($this->temoignages->removeElement($temoignage)) {
            // set the owning side to null (unless already changed)
            if ($temoignage->getOffres() === $this) {
                $temoignage->setOffres(null);
            }
        }

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }
}
