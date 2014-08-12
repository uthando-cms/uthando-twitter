<?php

namespace UthandoTwitter;

class Module
{	
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
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
