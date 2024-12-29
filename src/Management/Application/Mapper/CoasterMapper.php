<?php

declare(strict_types=1);


namespace App\Management\Application\Mapper;

use App\Management\Domain\Model\Coaster;
use App\Management\Infrastructure\Dto\CoasterRequest;
use DateTime;
use JsonException;

class CoasterMapper
{
    public function fromRequest(CoasterRequest $coasterRequest, ?string $coasterId = null): Coaster
    {
        return new Coaster(
            id: $coasterId,
            staffCount: $coasterRequest->liczba_personelu,
            customerCount: $coasterRequest->liczba_klientow,
            length: $coasterRequest->dl_trasy,
            hoursFrom: DateTime::createFromFormat('H:i', $coasterRequest->godziny_od),
            hoursTo: DateTime::createFromFormat('H:i', $coasterRequest->godziny_do),
        );
    }

    /**
     * @throws JsonException
     */
    public function toRedis(Coaster $coaster): string
    {
        return json_encode($coaster->toArray(), JSON_THROW_ON_ERROR);
    }

    public function fromRedis(string $data): Coaster
    {
        $data = json_decode($data, true);

        return new Coaster(
            id: $data['id'],
            staffCount: $data['staffCount'],
            customerCount: $data['customerCount'],
            length: $data['length'],
            hoursFrom: DateTime::createFromFormat('H:i', $data['hoursFrom']),
            hoursTo: DateTime::createFromFormat('H:i', $data['hoursTo']),
        );
    }
}
