<?php

declare(strict_types=1);

namespace App\Management\Application\UseCase\Command;

use App\Management\Domain\Repository\WagonRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class DeleteWagonCommandHandler
{
    public function __construct(
        private WagonRepository $wagonRepository,
    )
    {
    }

    public function __invoke(StoreWagonCommand $storeWagonCommand): void
    {
        $this->wagonRepository->delete();
    }

}
