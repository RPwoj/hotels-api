<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AmenityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AmenityRepository::class)]
#[ApiResource]
class Amenity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['hotel:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['hotel:read'])]
    private ?string $name = null;

    #[ORM\Column(unique: true)]
    private ?int $amenityOrder = null;

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

    public function getAmenityOrder(): ?int
    {
        return $this->amenityOrder;
    }

    public function setAmenityOrder(int $amenityOrder): static
    {
        $this->amenityOrder = $amenityOrder;

        return $this;
    }
}
