<?php
namespace UthandoTwitter\Service;

use UthandoTwitter\Service\Twitter as TwitterService;
use Traversable;
use Zend\Cache\StorageFactory;
use ZendService\Twitter\Twitter;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ArrayUtils;

class TwitterFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $services)
    {
        $config  = $services->get('config');
        
        if ($config instanceof Traversable) {
            $config = ArrayUtils::iteratorToArray($config);
        }
        
        $config = $config['uthando-twitter'];
        $twitter = new Twitter($config['oauth_options']);

        $cache = (isset($config['cache'])) ? StorageFactory::factory($config['cache']) : null;

        $service = new TwitterService();
        
        $service->setOptions($config['options'])
            ->setTwitter($twitter)
            ->setCache($cache);

        $service->setCache($cache);
        
        return $service;
    }
}