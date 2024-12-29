<?php

declare(strict_types=1);


namespace App\Management\Application\Mapper;

use App\Management\Domain\Model\Wagon;
use App\Management\Infrastructure\Dto\WagonRequest;

class WagonMapper
{

    public function fromRequest(WagonRequest $coasterRequest, ?string $coasterId = null): Wagon
    {
        return new Wagon(
            id: null,
            coasterId: $coasterId,
            seats: $coasterRequest->ilosc_miejsc,
            speed: $coasterRequest->predkosc_wagonu,
        );
    }

    public function toRedis(Wagon $wagon): string
    {
        return json_encode($wagon->toArray(), JSON_THROW_ON_ERROR);
    }

    public function fromRedis(string $data): Wagon
    {
        $data = json_decode($data, true);

        return new Wagon(
            id: $data['id'],
            coasterId: $data['coaster_id'],
            seats: $data['seats'],
            speed: $data['speed'],
        );
    }
}
