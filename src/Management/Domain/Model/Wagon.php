<?php

declare(strict_types=1);


namespace App\Management\Domain\Model;

use App\Common\Domain\Model\AggregateRoot;

class Wagon extends AggregateRoot
{
    public function __construct(
        public ?string $id,
        public string $coasterId,
        public readonly int $seats,
        public readonly float $speed,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'coaster_id' => $this->coasterId,
            'seats' => $this->seats,
            'speed' => $this->speed,
        ];
    }
}
