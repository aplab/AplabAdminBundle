<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 13.08.2018
 * Time: 16:08
 */

namespace Aplab\AplabAdminBundle\Component\Menu;



use http\Exception\RuntimeException;
use Psr\SimpleCache\CacheInterface;

class MenuManager
{
    const STRUCTURE_LOCATION_DEFAULT = './main_menu_structure_default.json';

    const KEY_ICON = 'icon';

    const KEY_ITEMS = 'items';

    const KEY_ACTION = 'action';

    const KEY_HANDLER = 'handler';

    const KEY_URL = 'url';

    const KEY_ROUTE = 'route';

    private $cacheKey;

    private $cache;

    private $structureLocation;

    private $structure;

    public function __construct(?string $structure_location, CacheInterface $cache)
    {
        $this->cache = $cache;
        $this->structureLocation = $structure_location;
        $this->cacheKey = join('.', [
            md5(__CLASS__),
            md5(static::STRUCTURE_LOCATION_DEFAULT),
            md5($this->structureLocation)
        ]);
    }

    /**
     * @return string
     */
    public function getCacheKey(): string
    {
        return $this->cacheKey;
    }

    /**
     * @return CacheInterface
     */
    public function getCache(): CacheInterface
    {
        return $this->cache;
    }

    /**
     * @return null|string
     */
    public function getStructureLocation(): ?string
    {
        return $this->structureLocation;
    }

    /**
     * @return mixed
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getStructure()
    {
        if (is_null($this->structure)) {
            if ($this->cache->has($this->cacheKey)) {
                $this->structure = $this->cache->get($this->cacheKey);
            } else {
                $this->buildStructure();
                if ($this->cache->has($this->cacheKey)) {
                    $this->structure = $this->cache->get($this->cacheKey);
                } else {
                    throw new RuntimeException('Main menu cache error');
                }
            }
        }
        return $this->structure;
    }

    /**
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    private function buildStructure()
    {
        $this->structure = rand(1, 1000000);
        $this->cache->set($this->cacheKey, $this->structure);
    }
}