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

use UthandoTwitter\Option\TwitterOptions;
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
    /**
     * @param ServiceLocatorInterface $services
     * @return mixed|Twitter
     */
    public function createService(ServiceLocatorInterface $services)
    {
        $config = $services->get('config');

        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }

        /* @var TwitterOptions $options */
        $options = $services->get(TwitterOptions::class);

        //$config = $config['uthando_social_media']['twitter'];
        $twitter = new ZendTwitter($options->getOauthOptions());


        /* @var AbstractAdapter $cache */
        $cache = ($options->getCache()) ? StorageFactory::factory($options->getCache()) : null;

        $service = new TwitterService();

        $service->setOptions($options->toArray())
            ->setTwitter($twitter)
            ->setCache($cache);

        return $service;
    }
}
