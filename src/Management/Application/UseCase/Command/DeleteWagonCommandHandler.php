<?php

declare(strict_types=1);

namespace App\Management\Application\UseCase\Command;

use App\Management\Domain\Model\Coaster;
use App\Management\Domain\Model\Wagon;
use App\Management\Domain\Repository\CoasterRepository;
use App\Management\Domain\Repository\WagonRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class DeleteWagonCommandHandler
{
    public function __construct(
        private CoasterRepository $coasterRepository,
        private WagonRepository $wagonRepository,
    )
    {
    }

    public function __invoke(DeleteWagonCommand $deleteWagonCommand): void
    {
        $coaster = new Coaster(
            id: $deleteWagonCommand->coasterId,
            staffCount: null, customerCount: null, length: null, hoursFrom: null, hoursTo: null
        );

        $coaster = $this->coasterRepository->get($coaster);

        if (!$coaster instanceof Coaster) {
            throw new \Exception('coaster not found');
        }

        $wagon = new Wagon(
            id: $deleteWagonCommand->wagonId,
            coasterId: $deleteWagonCommand->coasterId,
            seats: null, speed: null,
        );

        $wagon = $this->wagonRepository->get($wagon);

        if (!$wagon instanceof Wagon) {
            throw new \Exception('wagon not found');
        }

        $this->wagonRepository->delete($wagon);
    }

}
