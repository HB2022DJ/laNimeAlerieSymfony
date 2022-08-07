<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Controller\NumberOfVisitsController;
use App\Repository\VisitRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisitRepository::class)]
#[
    ApiResource(
        collectionOperations: [
            'get_visit' => [
                'security' => ' is_granted("ROLE_STATS")',
                'method'   => 'GET',
                'path' => '/stats/numberOfVisits',
                'controller' => NumberOfVisitsController::class,
            ],
        ],
        itemOperations: [
            'get' => [
                'security' => ' is_granted("ROLE_STATS")',
                'method'   => 'GET',

            ],
        ]
    )
]
class Visit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
