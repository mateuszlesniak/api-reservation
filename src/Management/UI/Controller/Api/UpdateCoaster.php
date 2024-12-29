<?php

declare(strict_types=1);


namespace App\Management\UI\Controller\Api;

use App\Management\Application\Mapper\CoasterMapper;
use App\Management\Application\UseCase\Command\UpdateCoasterCommand;
use App\Management\Infrastructure\Dto\CoasterRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class UpdateCoaster extends AbstractController
{
    public function __construct(
        private readonly CoasterMapper $coasterMapper,
        private readonly MessageBusInterface $bus,
    )
    {
    }

    #[Route(
        path: 'api/coasters/{coasterId}',
        name: 'api_update_coasters',
        methods: ['PUT'],
        format: 'json'
    )]
    public function __invoke(
        string $coasterId,
        #[MapRequestPayload(
            acceptFormat: 'json',
            validationGroups: ['update_coasters'],
            validationFailedStatusCode: Response::HTTP_NOT_FOUND
        )] CoasterRequest $coasterRequest
    ): JsonResponse
    {
        $coaster = $this->coasterMapper->fromRequest($coasterRequest, $coasterId);

        $this->bus->dispatch(new UpdateCoasterCommand($coaster));

        return $this->json(null, Response::HTTP_OK);
    }
}
