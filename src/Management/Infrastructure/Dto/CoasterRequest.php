<?php

declare(strict_types=1);

namespace App\Management\Infrastructure\Dto;

use Symfony\Component\Validator\Constraints as Assert;

readonly class CoasterRequest
{
    public function __construct(

        #[Assert\NotNull(groups: ['store_coasters', 'update_coasters'])]
        #[Assert\PositiveOrZero(groups: ['store_coasters', 'update_coasters'])]
        public int $liczba_personelu,

        #[Assert\NotNull(groups: ['store_coasters', 'update_coasters'])]
        #[Assert\PositiveOrZero(groups: ['store_coasters', 'update_coasters'])]
        public int $liczba_klientow,

        #[Assert\NotNull(groups: ['store_coasters', 'update_coasters'])]
        #[Assert\Time(groups: ['store_coasters', 'update_coasters'], withSeconds: false)]
        public string $godziny_od,

        #[Assert\NotNull(groups: ['store_coasters', 'update_coasters'])]
        #[Assert\Time(groups: ['store_coasters', 'update_coasters'], withSeconds: false)]
        public string $godziny_do,

        #[Assert\NotNull(groups: ['store_coasters'])]
        #[Assert\Blank(groups: ['update_coasters'])]
        #[Assert\Positive(groups: ['store_coasters'])]
        public ?int $dl_trasy = null,
    )
    {
    }
}
