<?php
use BitWeb\Mail\Service\MailService;
use BitWeb\MailModule\Service\Factory\MailServiceFactory;

return [
    'mail' => [
        'sendAllMailsTo' => null,
        'sendAllMailsToBcc' => null, // Add additional receivers, usually empty array for local
        'smtpOptions' => [
            'name' => 'example.ee',
            'host' => 'smtp.example.ee',
            'port' => '25',
            'connection_class' => 'login',
            'connection_config' => [
                'ssl' => 'tls',
                'username' => 'you@example.ee',
                'password' => ''
            ]
        ],
    ],
    'service_manager' => [
        'factories' => [
            MailService::class => MailServiceFactory::class,
        ]
    ]
];
