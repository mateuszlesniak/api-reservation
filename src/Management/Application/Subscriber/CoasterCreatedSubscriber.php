<?php

declare(strict_types=1);


namespace App\Management\Application\Subscriber;

use App\Management\Domain\Events\CoasterCreated;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class CoasterCreatedSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            CoasterCreated::class => 'onCoasterCreated',
        ];
    }

    public function onCoasterCreated(CoasterCreated $event): void
    {
        /**
         * todo:
         * - get requirements from task as separate classes (from domain)
         * - using tag attribute (for gathering) iterate on them and check every point
         * - if something is different than in description - push some logs
         */
    }
}
