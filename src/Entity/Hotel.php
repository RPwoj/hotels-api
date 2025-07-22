<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\HotelRepository;
use App\State\HotelProcessor;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: HotelRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['hotel:read']],
    denormalizationContext: ['groups' => ['hotel:write']],
    operations: [
        new Post(processor: HotelProcessor::class),
        new Get(),
        new GetCollection(),
        new Patch(),
        new Delete(),
    ]
)]
class Hotel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['hotel:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['hotel:read', 'hotel:write'])]
    #[Assert\NotBlank(message: "Hotel name cannot be empty.")]
    private ?string $name = null;

    /**
     * @var Collection<int, Amenity>
     */
    #[ORM\ManyToMany(targetEntity: Amenity::class)]
    #[Groups(['hotel:read', 'hotel:write'])]
    private Collection $amenities;

    public function __construct()
    {
        $this->amenities = new ArrayCollection();
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
    public function getAmenities(): Collection
    {
        return $this->amenities;
    }

    public function addAmenity(Amenity $amenity): static
    {
        if (!$this->amenities->contains($amenity)) {
            $this->amenities->add($amenity);
        }

        return $this;
    }

    public function removeAmenity(Amenity $amenity): static
    {
        $this->amenities->removeElement($amenity);

        return $this;
    }
}