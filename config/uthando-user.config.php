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
];
