<?php

declare(strict_types=1);

namespace App\Management\Application\UseCase\Command;

use App\Management\Domain\Model\Coaster;
use App\Management\Domain\Repository\CoasterRepository;
use App\Management\Domain\Repository\WagonRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class StoreWagonCommandHandler
{
    public function __construct(
        private CoasterRepository $coasterRepository,
        private WagonRepository $wagonRepository,
    )
    {
    }

    public function __invoke(StoreWagonCommand $storeWagonCommand): void
    {
        $coaster = new Coaster(
            id: $storeWagonCommand->wagon->coasterId,
            staffCount: null, customerCount: null, length: null, hoursFrom: null, hoursTo: null
        );

        $coaster = $this->coasterRepository->get($coaster);

        if (!$coaster instanceof Coaster) {
            throw new \Exception('coaster not found');
        }

        $this->wagonRepository->store($storeWagonCommand->wagon);
    }

}
