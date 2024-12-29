<?php

declare(strict_types=1);


namespace App\Common\Domain\Model;

abstract class AggregateRoot implements \JsonSerializable
{
    abstract public function toArray(): array;

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
