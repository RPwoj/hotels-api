<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Entity\Hotel;
use App\Repository\HotelRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class HotelProcessor implements ProcessorInterface
{
    public function __construct(
        private HotelRepository $hotelRepository,
        private EntityManagerInterface $entityManager
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): mixed
    {
        if (!$data instanceof Hotel) {
            return $data;
        }

        // Limit to 10 hotels max
        $hotelCount = $this->hotelRepository->count([]);
        if ($hotelCount >= 10 && $data->getId() === null) {
            throw new BadRequestHttpException('Cannot create more than 10 hotels.');
        }

        $this->entityManager->persist($data);
        $this->entityManager->flush();

        return $data;
    }
}