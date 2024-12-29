<?php

declare(strict_types=1);

namespace App\Management\Application\UseCase\Command;

use App\Management\Domain\Repository\CoasterRepository;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class UpdateCoasterCommandHandler
{
    public function __construct(
        private CoasterRepository $coasterRepository,
    )
    {
    }

    public function __invoke(StoreCoasterCommand $storeCoasterCommand): void
    {
        $this->coasterRepository->update($storeCoasterCommand->coaster);
    }

}
