<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 22.08.2018
 * Time: 15:19
 */

namespace Aplab\AplabAdminBundle\Component\ActionMenu;

use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Class ActionMenuManager
 * @package Aplab\AplabAdminBundle\Component\ActionMenu
 */
class ActionMenuManager
{
    /**
     * @var UrlGeneratorInterface
     */
    private $router;

    /**
     * ActionMenuManager constructor.
     * @param UrlGeneratorInterface $router
     */
    public function __construct(UrlGeneratorInterface $router)
    {
        $this->router = $router;
        Route::setRouter($router);
    }

    /**
     * @var string
     */
    const DEFAULT_INSTANCE_NAME = 'apl-admin-action-menu';

    /**
     * @var ActionMenu[]
     */
    private $instances = [];

    /**
     * @param string $id
     * @return ActionMenu
     * @throws Exception
     */
    public function getInstance($id = self::DEFAULT_INSTANCE_NAME)
    {
        if (!isset($this->instances[$id])) {
            $this->instances[$id] = new ActionMenu($id);
            if ($id === static::DEFAULT_INSTANCE_NAME) {
                $this->preconfigureDefaultInstance($this->instances[$id]);
            }
        }
        return $this->instances[$id];
    }

    /**
     * @param ActionMenu $menu
     * @throws Exception
     */
    private function preconfigureDefaultInstance(ActionMenu $menu)
    {
        for ($i = 1; $i < 20; $i++) {
            $menu->addItem(new MenuItem('test_id' . $i, 'test name test nametest nametest name'));
            MenuItem::getInstance('test_id' . $i)
                ->setAction(new Route('admin_desktop'))
                ->addIcon(new Icon('fas fa-shipping-fast text-danger'))
                ->addIcon(new Icon('fas fa-thumbtack text-success small'));
        }
    }

    /**
     * @return UrlGeneratorInterface
     */
    public function getRouter(): UrlGeneratorInterface
    {
        return $this->router;
    }

    /**
     * @param UrlGeneratorInterface $router
     * @return ActionMenuManager
     */
    public function setRouter(UrlGeneratorInterface $router): ActionMenuManager
    {
        $this->router = $router;
        return $this;
    }
}