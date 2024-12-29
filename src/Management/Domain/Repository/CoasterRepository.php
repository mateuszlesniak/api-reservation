<?php

declare(strict_types=1);


namespace App\Management\Domain\Repository;

use App\Management\Domain\Model\Coaster;

interface CoasterRepository
{
    public function get(Coaster $coaster): ?Coaster;

    public function store(Coaster $coaster): void;

    public function update(Coaster $coaster): void;
}
