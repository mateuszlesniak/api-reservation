<?php

declare(strict_types=1);


namespace App\Management\Domain\Events;

use App\Management\Domain\Model\Coaster;

readonly class CoasterCreated
{

    public function __construct(
        public Coaster $coaster
    )
    {
    }
}
