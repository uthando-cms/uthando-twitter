<?php

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'guest' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                'UthandoTwitter\Controller\Twitter' => ['action' => ['twitter-feed']],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                'UthandoTwitter\Controller\Twitter',
            ],
        ],
    ],
    'controllers' => [
        'invokables' => [
            'UthandoTwitter\Controller\Twitter' => 'UthandoTwitter\Controller\TwitterController',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'UthandoTwitter\Service\Twitter' => 'UthandoTwitter\Service\TwitterFactory',
        ],
    ],
    'view_helpers' => [
        'invokables' => [
            'TweetFeed' => 'UthandoTwitter\View\TweetFeed',
        ],
    ],
    'view_manager' => [
        'template_map' => [
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
                        'controller'    => 'Twitter',
                        'action'        => 'twitter-feed',
                        'force-ssl'     => 'http'
                    ],
                ],
                'may_terminate' => true,
            ],
        ],
    ],
];
