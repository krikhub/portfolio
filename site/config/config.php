<?php

return [
    'debug' => false,
    'yaml.handler' => 'symfony',
    'panel' => [
        'language' => 'de'
    ],

    'freelancer.email' => 'info@alexanderkrikun.de',

    // DomainFactory: Vom eigenen Server aus geht es oft 端ber mail()
    'email' => [
        'transport' => [
            'type' => 'mail',
        ]
    ],
];