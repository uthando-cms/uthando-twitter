<?php
/**
 * Uthando CMS (http://www.shaunfreeman.co.uk/)
 *
 * @package   UthandoTwitter\Service
 * @author    Shaun Freeman <shaun@shaunfreeman.co.uk>
 * @copyright Copyright (c) 2014 Shaun Freeman. (http://www.shaunfreeman.co.uk)
 * @license   see LICENSE
 */

namespace UthandoTwitter\Service;

use UthandoTwitter\Service\Twitter as TwitterService;
use Traversable;
use Zend\Cache\Storage\Adapter\AbstractAdapter;
use Zend\Cache\StorageFactory;
use ZendService\Twitter\Twitter as ZendTwitter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

/**
 * Class TwitterFactory
 *
 * @package UthandoTwitter\Service
 */
class TwitterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }

        $config = $config['uthando_twitter'];
        $twitter = new ZendTwitter($config['oauth_options']);


        /* @var AbstractAdapter $cache */
        $cache = (isset($config['cache'])) ? StorageFactory::factory($config['cache']) : null;

        $service = new TwitterService();

        $service->setOptions($config['options'])
            ->setTwitter($twitter)
            ->setCache($cache);

        $service->setCache($cache);

        return $service;
    }
}
