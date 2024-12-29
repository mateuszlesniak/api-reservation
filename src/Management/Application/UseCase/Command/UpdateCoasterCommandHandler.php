<?php

declare(strict_types=1);

namespace App\Management\Application\UseCase\Command;

use App\Management\Domain\Model\Coaster;
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

    public function __invoke(UpdateCoasterCommand $storeCoasterCommand): void
    {
        $coaster = $this->coasterRepository->get($storeCoasterCommand->coaster);

        if (!$coaster instanceof Coaster) {
            throw new \Exception('coaster should be instance of Coaster'); //todo
        }

        $this->applyUpdatedData($storeCoasterCommand->coaster, $coaster);
        $this->coasterRepository->update($coaster);
    }


    private function applyUpdatedData(Coaster $updatedCoaster, Coaster $coaster): void
    {
        $coaster->staffCount = $updatedCoaster->staffCount;
        $coaster->customerCount = $updatedCoaster->customerCount;
        $coaster->hoursFrom = $updatedCoaster->hoursFrom;
        $coaster->hoursTo = $updatedCoaster->hoursTo;
    }
}
