<?php

/**
 * The config file is optional. It accepts a return array with config options
 * Note: Never include more than one return statement, all options go within this single return array
 * In this example, we set debugging to true, so that errors are displayed onscreen. 
 * This setting must be set to false in production.
 * All config options: https://getkirby.com/docs/reference/system/options
 */
return [
    'debug' => true,
    'yaml.handler' => 'symfony',
    'panel' => [
        'language' => 'de'
    ],
    
    // Cache deaktivieren für saubere Deployments
    'cache' => [
        'pages' => [
            'active' => false
        ]
    ],

    // Freelancer-Formular: Empfänger-E-Mail
    'freelancer.email' => 'info@alexanderkrikun.de',  // Hier deine E-Mail-Adresse eintragen

    // SMTP E-Mail-Konfiguration für DomainFactory
    'email' => [
        'transport' => [
            'type' => 'smtp',
            'host' => 'sslout.df.eu',        // SMTP-Server von DomainFactory
            'port' => 465,                    // SSL Port
            'security' => 'ssl',              // SSL/TLS Verschlüsselung
            'auth' => true,                    // Authentifizierung erforderlich
            'username' => 'info@alexanderkrikun.de',  // Deine vollständige E-Mail-Adresse
            'password' => 'Iskander28$$',    // Dein Passwort aus DomainFactory Kundenmenü
        ]
    ],
];
