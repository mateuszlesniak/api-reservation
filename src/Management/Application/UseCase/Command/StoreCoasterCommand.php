<?php

declare(strict_types=1);

namespace App\Management\Application\UseCase\Command;

use App\Management\Domain\Model\Coaster;

readonly class StoreCoasterCommand
{
    public function __construct(
        public Coaster $coaster,
    )
    {
    }
}