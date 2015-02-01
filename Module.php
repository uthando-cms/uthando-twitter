<?php

namespace UthandoTwitter;

class Module
{	
    public function getConfig()
    {
        return include __DIR__ . '/config/config.php';
    }
    
    public function getControllerConfig()
    {
        return [
            'invokables' => [
                'UthandoTwitter\Controller\Twitter' => 'UthandoTwitter\Controller\TwitterController',
            ],
        ];
    }
    
    public function getServiceConfig()
    {
    	return [
            'factories' => [
                'UthandoTwitter\Service\Twitter' => 'UthandoTwitter\Service\TwitterFactory',
            ],
        ];
    }
    
    public function getViewHelperConfig()
    {
        return [
            'invokables' => [
            	'TweetFeed' => 'UthandoTwitter\View\TweetFeed',
            ], 
        ];
    }
    
    public function getAutoloaderConfig()
    {
    	return [
    		'Zend\Loader\ClassMapAutoloader' => [
    			__DIR__ . '/autoload_classmap.php'
    		],
    	];
    }
}
