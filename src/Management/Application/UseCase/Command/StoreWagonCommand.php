<?php

declare(strict_types=1);

namespace App\Management\Application\UseCase\Command;

use App\Management\Domain\Model\Wagon;

readonly class StoreWagonCommand
{
    public function __construct(
        public Wagon $wagon,
    )
    {
    }
}
