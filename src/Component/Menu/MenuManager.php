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

/**
 * Class MenuManager
 * @package Aplab\AplabAdminBundle\Component\Menu
 */
class MenuManager
{
    const STRUCTURE_LOCATION_DEFAULT = __DIR__ . '/menu_structure_default.json';

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
        $this->structureLocation = $structure_location ?? static::STRUCTURE_LOCATION_DEFAULT;
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
     * @throws Exception
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
     * @throws Exception
     */
    private function buildStructure()
    {
        $json = file_get_contents($this->structureLocation);
        $data = json_decode($json);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new \RuntimeException(json_last_error_msg(), json_last_error());
        }
        foreach ($data as $instance_name => $menu_data) {
            $menu = new Menu($instance_name);
            dump($menu);
        }


        dd($data);
    }
}