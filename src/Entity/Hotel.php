<?php

namespace App\Entity;

use App\Repository\HotelRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
class Hotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Amenity>
     */
    #[ORM\ManyToMany(targetEntity: Amenity::class, inversedBy: 'hotels')]
    private Collection $amenitites;

    public function __construct()
    {
        $this->amenitites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Amenity>
     */
    public function getAmenitites(): Collection
    {
        return $this->amenitites;
    }

    public function addAmenitite(Amenity $amenitite): static
    {
        if (!$this->amenitites->contains($amenitite)) {
            $this->amenitites->add($amenitite);
        }

        return $this;
    }

    public function removeAmenitite(Amenity $amenitite): static
    {
        $this->amenitites->removeElement($amenitite);

        return $this;
    }
}
