<?php

declare(strict_types=1);

namespace App\Management\Infrastructure\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class WagonRequest
{
    public function __construct(

        #[Assert\NotNull(groups: ['store_wagons'])]
        #[Assert\Positive(groups: ['store_wagons'])]
        public int $ilosc_miejsc,

        #[Assert\NotNull(groups: ['store_wagons'])]
        #[Assert\Positive(groups: ['store_wagons'])]
        public float $predkosc_wagonu,
    )
    {
    }
}
