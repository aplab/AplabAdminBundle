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
use Symfony\Component\HttpFoundation\RequestStack;

class AdminControllerHelper
{
    /**
     * @var MenuManager
     */
    protected $menuManager;

    /**
     * @var ActionMenuManager
     */
    protected $actionMenuManager;

    /**
     * @var ToolbarManager
     */
    protected $toolbarManager;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * AdminControllerHelper constructor.
     * @param MenuManager $menuManager
     * @param ActionMenuManager $actionMenuManager
     * @param ToolbarManager $toolbarManager
     * @param RequestStack $requestStack
     */
    public function __construct(MenuManager $menuManager,
                                ActionMenuManager $actionMenuManager,
                                ToolbarManager $toolbarManager,
                                RequestStack $requestStack)
    {
        $this->menuManager = $menuManager;
        $this->actionMenuManager = $actionMenuManager;
        $this->toolbarManager = $toolbarManager;
        $this->requestStack = $requestStack;
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

    /**
     * @return RequestStack
     */
    public function getRequestStack(): RequestStack
    {
        return $this->requestStack;
    }

    /**
     * @return null|\Symfony\Component\HttpFoundation\Request
     */
    public function getMasterRequest()
    {
        return $this->requestStack->getMasterRequest();
    }

    /**
     * @return string
     */
    public function getModulePath()
    {
        return join('/', array_slice(explode('/', '/' . trim($this->getMasterRequest()->getPathInfo(), '/')), 0, 3));
    }

    /**
     * @return string
     */
    public function getBundlePath()
    {
        return join('/', array_slice(explode('/', '/' . trim($this->getMasterRequest()->getPathInfo(), '/')), 0, 2));
    }
}