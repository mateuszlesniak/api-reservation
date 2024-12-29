<?php

declare(strict_types=1);


namespace App\Management\Domain\Model;

use App\Common\Domain\Model\AggregateRoot;
use DateTime;

class Coaster extends AggregateRoot
{
    public function __construct(
        public ?string $id,
        public readonly int $staffCount,
        public readonly int $customerCount,
        public readonly ?int $length,
        public readonly DateTime $hoursFrom,
        public readonly DateTime $hoursTo,
    )
    {
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id ?? '',
            'staffCount' => $this->staffCount,
            'customerCount' => $this->customerCount,
            'length' => $this->length,
            'hoursFrom' => $this->hoursFrom->format('H:i'),
            'hoursTo' => $this->hoursTo->format('H:i'),
        ];
    }


}
