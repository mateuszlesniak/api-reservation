<?php

declare(strict_types=1);


namespace App\Management\Domain\Repository;

use App\Management\Domain\Model\Wagon;

interface WagonRepository
{
    public function get(Wagon $wagon): ?Wagon;

    public function store(Wagon $wagon): void;

    public function delete(Wagon $wagon): void;
}
