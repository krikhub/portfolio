# Freelancer-Anfrageformular - Setup-Anleitung

## Installation abgeschlossen ✓

Das 3-stufige Freelancer-Anfrageformular wurde erfolgreich installiert.

## Erstellte Dateien

- `site/templates/freelancer.php` - Formular-Template
- `site/blueprints/pages/freelancer.yml` - Panel-Blueprint
- `content/freelancer-anfrage/freelancer.txt` - Content-Datei
- `assets/css/templates/freelancer.css` - Formular-Styles
- `site/templates/home.php` - Aktualisiert mit CTA-Button

## Nächste Schritte

### 1. SMTP-Konfiguration einrichten

Öffne `site/config/config.php` und passe die E-Mail-Einstellungen an:

```php
'freelancer.email' => 'deine-email@example.com', // Empfänger-Adresse

'email' => [
    'transport' => [
        'type' => 'smtp',
        'host' => 'smtp.example.com',      // Dein SMTP-Server
        'port' => 587,                      // SMTP-Port
        'security' => 'tls',                // tls oder ssl
        'auth' => true,
        'username' => 'deine-email@example.com',
        'password' => 'dein-passwort',
    ]
],
```

### 2. Seite im Browser aufrufen

- Startseite: Zeigt den "Freelancer buchen" Button
- Formular: `https://deine-domain.de/freelancer-anfrage`

### 3. Formular-Features

✓ 3-stufiger Prozess mit Fortschrittsanzeige
✓ Validierung auf jedem Step
✓ Responsive Design
✓ E-Mail-Versand ohne Datenbank
✓ Minimalistisches Design passend zu deiner Seite

## Formular-Struktur

**Stage 1 - Projektdaten:**
- Projektname, Zeitraum, Projektort, Arbeitszeiten

**Stage 2 - Projektbedarf:**
- Art des Einsatzes (Mehrfachauswahl)
- Technologien
- Beschreibung/Briefing

**Stage 3 - Kontaktdaten:**
- Ansprechpartner, Unternehmen, E-Mail, Telefon

## Anpassungen

Die Texte kannst du im Kirby Panel unter "Freelancer-Anfrage" bearbeiten.
Das Design kannst du in `assets/css/templates/freelancer.css` anpassen.
