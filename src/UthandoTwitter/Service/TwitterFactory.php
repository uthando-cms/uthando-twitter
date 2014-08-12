<?php
namespace UthandoTwitter\Service;

use UthandoTwitter\Service\Twitter as TwitterService;
use Traversable;
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
        
        $model = new TwitterService();
        
        $model->setOptions($config['options'])
            ->setTwitter($twitter);
        
        return $model;
    }
}