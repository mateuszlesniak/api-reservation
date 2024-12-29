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
    private const string KEY_TEMPLATE = 'coaster_%s';

    public function __construct(
        private CoasterMapper $mapper,
        private CacheInterface $cache,
    )
    {
    }

    public function get(Coaster $coaster): ?Coaster
    {
        $data = $this->cache->get(
            $this->createKey($coaster),
            function (ItemInterface $item): void {
            }
        );

        if (empty($data)) {
            return null;
        }

        return $this->mapper->fromRedis($data);
    }

    public function store(Coaster $coaster): void
    {
        $coaster->id = Uuid::v4()->toString();

        $this->cache->get(
            $this->createKey($coaster),
            function (ItemInterface $item) use ($coaster): string {
                return $this->mapper->toRedis($coaster);
            }
        );
    }

    public function update(Coaster $coaster): void
    {
        $key = $this->createKey($coaster);

        $this->cache->delete($key);
        $this->cache->get($key,
            function (ItemInterface $item) use ($coaster): string {
                return $this->mapper->toRedis($coaster);
            }
        );
    }

    private function createKey(Coaster $coaster): string
    {
        if (empty($coaster->id)) {
            throw new \Exception('coaster id cannot be empty');
        }

        return sprintf(static::KEY_TEMPLATE, $coaster->id);
    }
}
