<?php

declare(strict_types=1);


namespace App\Management\Domain\Repository;

use App\Management\Domain\Model\Wagon;

interface WagonRepository
{
    public function store(Wagon $wagon): void;

    public function delete(Wagon $wagon): void;
}
