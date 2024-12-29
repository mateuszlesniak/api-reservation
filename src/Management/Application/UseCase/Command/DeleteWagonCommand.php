<?php

declare(strict_types=1);

namespace App\Management\Application\UseCase\Command;

readonly class DeleteWagonCommand
{
    public function __construct(
        public string $coasterId,
        public string $wagonId,
    )
    {
    }
}
