<?php

declare(strict_types=1);


namespace App\Management\UI\Controller\Api;

use App\Management\Application\Mapper\CoasterMapper;
use App\Management\Application\Mapper\WagonMapper;
use App\Management\Application\UseCase\Command\StoreWagonCommand;
use App\Management\Infrastructure\Dto\CoasterRequest;
use App\Management\Infrastructure\Dto\WagonRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class StoreWagon extends AbstractController
{

    public function __construct(
        private readonly WagonMapper $wagonMapper,
        private readonly MessageBusInterface $bus,
    )
    {
    }

    #[Route(
        path: 'api/coasters/{coasterId}/wagons',
        name: 'api_store_wagons',
        methods: ['POST'],
        format: 'json'
    )]
    public function __invoke(
        #[MapRequestPayload(
            acceptFormat: 'json',
            validationGroups: ['store_wagons'],
            validationFailedStatusCode: Response::HTTP_NOT_FOUND
        )] WagonRequest $wagonRequest
    ): JsonResponse
    {
        $wagon = $this->wagonMapper->fromRequest($wagonRequest);

        $this->bus->dispatch(new StoreWagonCommand($wagon));

        return $this->json(null, Response::HTTP_CREATED);
    }
}
