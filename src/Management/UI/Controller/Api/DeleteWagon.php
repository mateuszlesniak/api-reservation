<?php

declare(strict_types=1);


namespace App\Management\UI\Controller\Api;

use App\Management\Application\UseCase\Command\DeleteWagonCommand;
use App\Management\Infrastructure\Dto\CoasterRequest;
use App\Management\Infrastructure\Dto\WagonRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

class DeleteWagon extends AbstractController
{

    public function __construct(
        private readonly MessageBusInterface $bus,
    )
    {
    }

    #[Route(
        path: 'api/coasters/{coasterId}/wagons/{wagonId}',
        name: 'api_delete_wagons',
        methods: ['DELETE'],
        format: 'json'
    )]
    public function __invoke(string $coasterId, string $wagonId): JsonResponse
    {
        $this->bus->dispatch(new DeleteWagonCommand($coasterId, $wagonId));
    }
}
