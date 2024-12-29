<?php

declare(strict_types=1);


namespace App\Management\Infrastructure\Repository\Redis;

use App\Management\Application\Mapper\CoasterMapper;
use App\Management\Domain\Model\Coaster;
use App\Management\Domain\Repository\CoasterRepository as CoasterRepositoryInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

readonly class CoasterRepository implements CoasterRepositoryInterface
{
    private const string KEY_TEMPLATE = 'coaster_%d';

    public function __construct(
        private CoasterMapper $mapper,
        private CacheInterface $cache,
    )
    {
    }

    public function store(Coaster $coaster): void
    {
        $coaster->id = Uuid::fromString(Uuid::NAMESPACE_OID)->toString();

        $this->cache->get(
            $this->createKey($coaster),
            function (ItemInterface $item) use ($coaster): string {
                $item->expiresAfter(0);

                return $this->mapper->toRedis($coaster);
            }
        );
    }

    public function update(Coaster $coaster): void
    {
        // TODO: Implement update() method.
    }

    private function createKey(Coaster $coaster): string
    {
        return sprintf(static::KEY_TEMPLATE, $coaster->id);
    }
}
