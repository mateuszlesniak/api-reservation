<?php

declare(strict_types=1);

namespace App\Management\Application\UseCase\Command;

use App\Management\Domain\Events\CoasterCreated;
use App\Management\Domain\Repository\CoasterRepository;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
readonly class StoreCoasterCommandHandler
{
    public function __construct(
        private CoasterRepository $coasterRepository,
        private EventDispatcherInterface $eventDispatcher,
    )
    {
    }

    public function __invoke(StoreCoasterCommand $storeCoasterCommand): void
    {
        $this->coasterRepository->store($storeCoasterCommand->coaster);

        $this->eventDispatcher->dispatch(
            new CoasterCreated($storeCoasterCommand->coaster),
        );
    }

}
