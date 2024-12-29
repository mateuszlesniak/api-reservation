<?php

declare(strict_types=1);


namespace App\Management\Application\Mapper;

use App\Management\Domain\Model\Wagon;
use App\Management\Infrastructure\Dto\WagonRequest;

class WagonMapper
{

    public function fromRequest(WagonRequest $coasterRequest): Wagon
    {
        return new Wagon(
            id: null,
            seats: $coasterRequest->ilosc_miejsc,
            speed: $coasterRequest->predkosc_wagonu,
        );
    }
}
