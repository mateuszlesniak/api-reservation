<?php

declare(strict_types=1);


namespace App\Management\Infrastructure\Repository\Redis;

use App\Management\Application\Mapper\WagonMapper;
use App\Management\Domain\Model\Wagon;
use App\Management\Domain\Repository\WagonRepository as WagonRepositoryInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

readonly class WagonRepository implements WagonRepositoryInterface
{
    private const string KEY_TEMPLATE = 'coaster_%s_wagon_%s';

    public function __construct(
        private WagonMapper $mapper,
        private CacheInterface $cache,
    )
    {
    }

    public function store(Wagon $wagon): void
    {
        $wagon->id = Uuid::fromString(Uuid::NAMESPACE_OID)->toString();

        $this->cache->get(
            $this->createKey($wagon),
            function (ItemInterface $item) use ($wagon): string {
                return $this->mapper->toRedis($wagon);
            }
        );
    }

    public function delete(Wagon $wagon): void
    {
        $this->cache->delete($this->createKey($wagon));
    }

    private function createKey(Wagon $wagon): string
    {
        return sprintf(static::KEY_TEMPLATE, $wagon->coasterId, $wagon->id);
    }
}
