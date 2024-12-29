<?php

declare(strict_types=1);


namespace App\Management\Infrastructure\Repository\Redis;

use App\Management\Domain\Model\Coaster;
use App\Management\Domain\Model\Wagon;
use App\Management\Domain\Repository\CoasterRepository as CoasterRepositoryInterface;
use App\Management\Domain\Repository\WagonRepository as WagonRepositoryInterface;

class WagonRepository implements WagonRepositoryInterface
{
    public function store(Wagon $wagon): void
    {
        // TODO: Implement store() method.
    }

    public function delete(int $wagonId): void
    {
        // TODO: Implement delete() method.
    }
}
