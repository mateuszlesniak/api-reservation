<?php

declare(strict_types=1);


namespace App\Management\Domain\Model;

class Coaster
{
    public function __construct(
        public readonly ?int $id,
        public readonly int $staffCount,
        public readonly int $customerCount,
        public readonly ?int $length,
        public readonly string $hoursFrom,
        public readonly string $hoursTo,
    )
    {
    }
}
