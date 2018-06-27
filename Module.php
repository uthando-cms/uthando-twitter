<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoTwitter
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoTwitter;

use UthandoCommon\Config\ConfigInterface;
use UthandoCommon\Config\ConfigTrait;
use UthandoTwitter\Event\AutoPostListener;
use Zend\Mvc\MvcEvent;

/**
 * Class Module
 *
 * @package UthandoTwitter
 */
class Module implements ConfigInterface
{
    use ConfigTrait;

    public function onBootStrap(MvcEvent $e)
    {
        $app            = $e->getApplication();
        $eventManager   = $app->getEventManager();
        $event          = new AutoPostListener();

        $event->attach($eventManager);
    }

    /**
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    /**
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\ClassMapAutoloader' => [
                __DIR__ . '/autoload_classmap.php'
            ],
        ];
    }
}
