<?php

declare(strict_types=1);


namespace App\Management\Infrastructure\Repository\Redis;

use App\Management\Domain\Model\Coaster;
use App\Management\Domain\Repository\CoasterRepository as CoasterRepositoryInterface;

class CoasterRepository implements CoasterRepositoryInterface
{
    public function store(Coaster $coaster): void
    {
        // TODO: Implement store() method.
    }

}
