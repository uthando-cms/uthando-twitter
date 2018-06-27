<?php

return [
    'asset_manager' => [
        'resolver_configs' => [
            'collections' => [
                'js/uthando.js' => [
                ],
                'css/uthando.css' => [
                ],
            ],
            'paths' => [
                'UthandoTwitter' => __DIR__ . '/../public',
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            \UthandoTwitter\Controller\TwitterController::class => \UthandoTwitter\Controller\TwitterController::class,
            \UthandoTwitter\Controller\SettingsController::class => \UthandoTwitter\Controller\SettingsController::class,
        ],
    ],
    'service_manager' => [
        'factories' => [
            \Facebook\Facebook::class => \UthandoTwitter\Service\FacebookFactory::class,
            \UthandoTwitter\Service\Twitter::class => \UthandoTwitter\Service\TwitterFactory::class,

            \UthandoTwitter\Option\FacebookOptions::class => \UthandoTwitter\Option\FacebookOptionsFactory::class,
            \UthandoTwitter\Option\TwitterOptions::class => \UthandoTwitter\Option\TwitterOptionsFactory::class,
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'TweetFeed' => \UthandoTwitter\View\TweetFeed::class,
        ],
    ],
    'view_manager' => [
        'template_map' => [
            'uthando-twitter/settings/index' => __DIR__ . '/../view/uthando-twitter/settings/index.phtml',
            'uthando-twitter/twitter/twitter-feed' => __DIR__ . '/../view/uthando-twitter/twitter/twitter-feed.phtml',
        ],
    ],
    'router' => [
        'routes' => [
            'twitter' => [
                'type'    => 'Segment',
                'options' => [
                    'route'    => '/twitter[/][:action]',
                    'constraints' => [
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ],
                    'defaults' => [
                        '__NAMESPACE__' => 'UthandoTwitter\Controller',
                        'controller'    => \UthandoTwitter\Controller\TwitterController::class,
                        'action'        => 'twitter-feed',
                    ],
                ],
                'may_terminate' => true,
            ],
        ],
    ],
];
