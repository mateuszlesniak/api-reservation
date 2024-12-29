<?php

declare(strict_types=1);


namespace App\Management\Domain\Model;

class Wagon
{
    public function __construct(
        public readonly int $seats,
        public readonly float $speed,
    )
    {
    }
}
