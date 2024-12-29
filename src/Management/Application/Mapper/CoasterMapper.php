<?php

declare(strict_types=1);


namespace App\Management\Application\Mapper;

use App\Management\Domain\Model\Coaster;
use App\Management\Infrastructure\Dto\CoasterRequest;
use JsonException;

class CoasterMapper
{
    public function fromRequest(CoasterRequest $coasterRequest, ?int $coasterId = null): Coaster
    {
        return new Coaster(
            id: $coasterId ?? null,
            staffCount: $coasterRequest->liczba_personelu,
            customerCount: $coasterRequest->liczba_klientow,
            length: $coasterRequest->dl_trasy ?? null,
            hoursFrom: $coasterRequest->godziny_od,
            hoursTo: $coasterRequest->godziny_do,
        );
    }

    /**
     * @throws JsonException
     */
    public function toRedis(Coaster $coaster): string
    {
        return json_encode($coaster->toArray(), JSON_THROW_ON_ERROR);
    }
}
