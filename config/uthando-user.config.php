<?php

return [
    'uthando_user' => [
        'acl' => [
            'roles' => [
                'guest' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                \UthandoTwitter\Controller\TwitterController::class => ['action' => ['twitter-feed']],
                            ],
                        ],
                    ],
                ],
                'admin' => [
                    'privileges' => [
                        'allow' => [
                            'controllers' => [
                                \UthandoTwitter\Controller\SettingsController::class => ['action' => 'all'],
                            ],
                        ],
                    ],
                ],
            ],
            'resources' => [
                \UthandoTwitter\Controller\TwitterController::class,
                \UthandoTwitter\Controller\SettingsController::class,
            ],
        ],
    ],
];
