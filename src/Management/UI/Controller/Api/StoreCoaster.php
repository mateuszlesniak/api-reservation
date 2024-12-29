<?php

declare(strict_types=1);


namespace App\Management\UI\Controller\Api;

use App\Management\Application\Mapper\CoasterMapper;
use App\Management\Application\UseCase\Command\StoreCoasterCommand;
use App\Management\Infrastructure\Dto\CoasterRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class StoreCoaster extends AbstractController
{
    public function __construct(
        private readonly CoasterMapper $coasterMapper,
        private readonly MessageBusInterface $bus,
    )
    {
    }

    #[Route(
        path: 'api/coasters',
        name: 'api_store_coasters',
        methods: ['POST'],
        format: 'json'
    )]
    public function __invoke(
        #[MapRequestPayload(
            acceptFormat: 'json',
            validationGroups: ['store_coasters'],
            validationFailedStatusCode: Response::HTTP_NOT_FOUND
        )] CoasterRequest $coasterRequest
    ): JsonResponse
    {
        try {
            $coaster = $this->coasterMapper->fromRequest($coasterRequest);

            $this->bus->dispatch(new StoreCoasterCommand($coaster));
        } catch (\Exception $exception) {
            return $this->json($exception->getMessage(), Response::HTTP_BAD_REQUEST);
        }

        return $this->json(null, Response::HTTP_CREATED);
    }
}
