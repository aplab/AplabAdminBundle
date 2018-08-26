<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 26.08.2018
 * Time: 12:03
 */

namespace Aplab\AplabAdminBundle\Component\Helper;


use Aplab\AplabAdminBundle\Component\ActionMenu\ActionMenuManager;
use Aplab\AplabAdminBundle\Component\Menu\MenuManager;
use Aplab\AplabAdminBundle\Component\Toolbar\ToolbarManager;

class AdminControllerHelper
{
    protected $menuManager;

    protected $actionMenuManager;

    protected $toolbarManager;

    public function __construct(MenuManager $menuManager,
                                ActionMenuManager $actionMenuManager,
                                ToolbarManager $toolbarManager)
    {
        $this->menuManager = $menuManager;
        $this->actionMenuManager = $actionMenuManager;
        $this->toolbarManager = $toolbarManager;
    }

    /**
     * @return MenuManager
     */
    public function getMenuManager(): MenuManager
    {
        return $this->menuManager;
    }

    /**
     * @return ActionMenuManager
     */
    public function getActionMenuManager(): ActionMenuManager
    {
        return $this->actionMenuManager;
    }

    /**
     * @return ToolbarManager
     */
    public function getToolbarManager(): ToolbarManager
    {
        return $this->toolbarManager;
    }

    /**
     * @param null $id
     * @return \Aplab\AplabAdminBundle\Component\Menu\Menu
     * @throws \Aplab\AplabAdminBundle\Component\Menu\Exception
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function getMenu($id = null)
    {
        if (is_null($id)) {
            return $this->menuManager->getMenu();
        }
        $this->menuManager->getMenu($id);
    }

    /**
     * @param null $id
     * @return \Aplab\AplabAdminBundle\Component\Toolbar\Toolbar
     * @throws \Aplab\AplabAdminBundle\Component\Toolbar\Exception
     */
    public function getToolbar($id = null)
    {
        if (is_null($id)) {
            return $this->toolbarManager->getInstance();
        }
        return $this->toolbarManager->getInstance($id);
    }

    /**
     * @param null $id
     * @return \Aplab\AplabAdminBundle\Component\ActionMenu\ActionMenu
     * @throws \Aplab\AplabAdminBundle\Component\ActionMenu\Exception
     */
    public function getActionMenu($id = null)
    {
        if (is_null($id)) {
            return $this->actionMenuManager->getInstance();
        }
        return $this->actionMenuManager->getInstance($id);
    }
}