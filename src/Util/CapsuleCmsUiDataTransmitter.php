<?php
/**
 * Created by PhpStorm.
 * User: polyanin
 * Date: 06.08.2018
 * Time: 17:12
 */

namespace Capsule\Util;


class CapsuleCmsUiDataTransmitter
{
    const COOKIE_KEY = 'capsule-cms-data';

    const CLASS_SIDEBAR_OPEN = 'capsule-cms-sidebar-open';

    const CLASS_SIDEBAR_PIN = 'capsule-cms-sidebar-pin';

    private $sidebarPin;

    private $sidebarOpen;

    public function __construct()
    {
        try {
            $data = json_decode($_COOKIE[static::COOKIE_KEY]);
        } catch (\Throwable $exception) {
            $data = new \stdClass;
        }
        try {
            $this->sidebarOpen = $data->sidebar_open;
        } catch (\Throwable $exception) {
            $this->sidebarOpen = false;
        }
        try {
            $this->sidebarPin = $data->sidebar_pin;
        } catch (\Throwable $exception) {
            $this->sidebarPin = false;
        }
    }

    /**
     * @return mixed
     */
    public function getSidebarPin()
    {
        return $this->sidebarPin;
    }

    /**
     * @param mixed $sidebarPin
     * @return CapsuleCmsUiDataTransmitter
     */
    public function setSidebarPin($sidebarPin)
    {
        $this->sidebarPin = (bool)$sidebarPin;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSidebarOpen()
    {
        return $this->sidebarOpen;
    }

    /**
     * @param mixed $sidebarOpen
     * @return CapsuleCmsUiDataTransmitter
     */
    public function setSidebarOpen($sidebarOpen)
    {
        $this->sidebarOpen = (bool)$sidebarOpen;
        return $this;
    }

    public function getBodyClasses()
    {
        $tmp = [];
        if ($this->getSidebarOpen()) {
            $tmp[] = static::CLASS_SIDEBAR_OPEN;
        }
        if ($this->getSidebarPin()) {
            $tmp[] = static::CLASS_SIDEBAR_PIN;
        }
        return join(' ', $tmp);
    }
}