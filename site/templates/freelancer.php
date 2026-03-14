<?php
/**
 * Freelancer Anfrage Template - 3-stufiges Formular
 */

// Formular-Verarbeitung
$success = false;
$errors = [];
$currentStep = get('step', 1);

if (r::is('post')) {
    $data = get();
    
    // Validierung für Step 3 (finale Absendung)
    if ($data['step'] == 3 && isset($data['submit'])) {
        // E-Mail Validierung
        if (empty($data['email']) || !v::email($data['email'])) {
            $errors[] = 'Bitte geben Sie eine gültige E-Mail-Adresse an.';
        }
        if (empty($data['ansprechpartner'])) {
            $errors[] = 'Bitte geben Sie einen Ansprechpartner an.';
        }
        
        // Wenn keine Fehler, E-Mail versenden
        if (empty($errors)) {
            try {
                // E-Mail-Inhalt zusammenstellen
                $emailBody = "Neue Freelancer-Anfrage\n\n";
                $emailBody .= "=== EINSATZ / PROJEKTDATEN ===\n";
                $emailBody .= "Projektname: " . ($data['projektname'] ?? '-') . "\n";
                $emailBody .= "Zeitraum von: " . ($data['zeitraum_von'] ?? '-') . "\n";
                $emailBody .= "Zeitraum bis: " . ($data['zeitraum_bis'] ?? '-') . "\n";
                $emailBody .= "Projektort: " . ($data['projektort'] ?? '-') . "\n";
                $emailBody .= "Arbeitszeiten: " . ($data['arbeitszeiten'] ?? '-') . "\n\n";
                
                $emailBody .= "=== PROJEKTBEDARF ===\n";
                $emailBody .= "Art des Einsatzes: " . (isset($data['einsatzart']) ? implode(', ', $data['einsatzart']) : '-') . "\n";
                $emailBody .= "Technologien: " . ($data['technologien'] ?? '-') . "\n";
                $emailBody .= "Beschreibung:\n" . ($data['beschreibung'] ?? '-') . "\n\n";
                
                $emailBody .= "=== KONTAKTDATEN ===\n";
                $emailBody .= "Ansprechpartner: " . $data['ansprechpartner'] . "\n";
                $emailBody .= "Unternehmen: " . ($data['unternehmen'] ?? '-') . "\n";
                $emailBody .= "E-Mail: " . $data['email'] . "\n";
                $emailBody .= "Telefon: " . ($data['telefon'] ?? '-') . "\n";
                
                // Prüfe ob wir lokal sind (localhost oder .local Domain)
                $isLocal = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1']) || 
                           strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0 ||
                           strpos($_SERVER['HTTP_HOST'], '.local') !== false;
                
                if ($isLocal) {
                    // Lokal: Speichere in Datei statt E-Mail zu senden
                    $logDir = kirby()->root('site') . '/logs';
                    if (!is_dir($logDir)) {
                        mkdir($logDir, 0755, true);
                    }
                    $logFile = $logDir . '/freelancer-anfragen.log';
                    $logEntry = "\n\n" . str_repeat('=', 80) . "\n";
                    $logEntry .= "Datum: " . date('d.m.Y H:i:s') . "\n";
                    $logEntry .= str_repeat('=', 80) . "\n";
                    $logEntry .= $emailBody;
                    file_put_contents($logFile, $logEntry, FILE_APPEND);
                    $success = true;
                } else {
                    // Produktiv: E-Mail versenden
                    $kirby->email([
                        'from' => 'noreply@' . $_SERVER['HTTP_HOST'],
                        'replyTo' => $data['email'],
                        'to' => option('freelancer.email', 'info@alexanderkrikun.de'),
                        'subject' => 'Neue Freelancer-Anfrage: ' . ($data['projektname'] ?? 'Ohne Projektnamen'),
                        'body' => $emailBody
                    ]);
                    $success = true;
                }
            } catch (Exception $e) {
                $errors[] = 'Fehler beim Versenden der Anfrage: ' . $e->getMessage();
            }
        }
    }
}

snippet('header');
?>

<article class="freelancer-form">
    <?php if (!$success): ?>
    <header class="intro">
        <h1><?= $page->headline()->or('Freelancer-Anfrage') ?></h1>
        <?php if ($page->text()->isNotEmpty()): ?>
            <p><?= $page->text() ?></p>
        <?php endif ?>
        <?php if ($page->subheadline()->isNotEmpty()): ?>
            <p><?= $page->subheadline() ?></p>
        <?php endif ?>
        
        <div class="form-notice" style="margin-top: 1rem;">
            <small>Diese Anfrage ist unverbindlich und kostenlos.</small>
        </div>
    </header>
    <?php endif ?>

    <?php if ($success): ?>
        <div class="form-success box">
            <h2>Vielen Dank für Ihre Anfrage!</h2>
            <p>Ich habe Ihre Nachricht erhalten und melde mich zeitnah bei Ihnen.</p>
            <?php if (in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1']) || strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0): ?>
                <p><small style="color: var(--color-text-dim);">Hinweis: Lokal wurde die Anfrage in site/logs/freelancer-anfragen.log gespeichert.</small></p>
            <?php endif ?>
            <a href="<?= $site->url() ?>" class="cta margin-l">Zurück zur Startseite</a>
        </div>
    <?php else: ?>
        
        <!-- Fortschrittsanzeige -->
        <div class="form-progress">
            <div class="progress-steps">
                <div class="progress-step <?= $currentStep >= 1 ? 'active' : '' ?> <?= $currentStep > 1 ? 'completed' : '' ?>">
                    <span class="step-number">1</span>
                    <span class="step-label">Projektdaten</span>
                </div>
                <div class="progress-step <?= $currentStep >= 2 ? 'active' : '' ?> <?= $currentStep > 2 ? 'completed' : '' ?>">
                    <span class="step-number">2</span>
                    <span class="step-label">Projektbedarf</span>
                </div>
                <div class="progress-step <?= $currentStep >= 3 ? 'active' : '' ?>">
                    <span class="step-number">3</span>
                    <span class="step-label">Kontakt</span>
                </div>
            </div>
        </div>

        <?php if (!empty($errors)): ?>
            <div class="form-errors">
                <?php foreach ($errors as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach ?>
            </div>
        <?php endif ?>

        <form method="post" class="freelancer-form-content" enctype="multipart/form-data">
            <input type="hidden" name="step" value="<?= $currentStep ?>">
            
            <!-- Stage 1: Einsatz / Projektdaten -->
            <div class="form-stage <?= $currentStep == 1 ? 'active' : '' ?>" data-stage="1">
                <h2 class="form-stage-title">Einsatz / Projektdaten</h2>
                
                <div class="form-field">
                    <label for="projektname">Projektname / Einsatzname</label>
                    <input type="text" id="projektname" name="projektname" value="<?= esc(get('projektname', '')) ?>" required>
                </div>

                <div class="form-row">
                    <div class="form-field">
                        <label for="zeitraum_von">Zeitraum von</label>
                        <input type="date" id="zeitraum_von" name="zeitraum_von" value="<?= esc(get('zeitraum_von', '')) ?>" required>
                    </div>
                    <div class="form-field">
                        <label for="zeitraum_bis">Zeitraum bis</label>
                        <input type="date" id="zeitraum_bis" name="zeitraum_bis" value="<?= esc(get('zeitraum_bis', '')) ?>" required>
                    </div>
                </div>

                <div class="form-field">
                    <label for="projektort">Projektort</label>
                    <select id="projektort" name="projektort" required>
                        <option value="">Bitte wählen</option>
                        <option value="Remote" <?= get('projektort', '') == 'Remote' ? 'selected' : '' ?>>Remote</option>
                        <option value="Vor Ort" <?= get('projektort', '') == 'Vor Ort' ? 'selected' : '' ?>>Vor Ort</option>
                        <option value="Hybrid" <?= get('projektort', '') == 'Hybrid' ? 'selected' : '' ?>>Hybrid</option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="arbeitszeiten">Arbeitszeiten / Verfügbarkeit</label>
                    <input type="text" id="arbeitszeiten" name="arbeitszeiten" value="<?= esc(get('arbeitszeiten', '')) ?>" placeholder="z.B. Vollzeit, 20h/Woche, flexibel">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-next cta" onclick="nextStep(2)">Weiter</button>
                </div>
            </div>

            <!-- Stage 2: Projektbedarf -->
            <div class="form-stage <?= $currentStep == 2 ? 'active' : '' ?>" data-stage="2">
                <h2 class="form-stage-title">Projektbedarf</h2>
                
                <div class="form-field">
                    <label>Art des Einsatzes (Mehrfachauswahl möglich)</label>
                    <div class="checkbox-group">
                        <?php 
                        $einsatzarten = ['Feature-Entwicklung', 'Bugfix', 'CMS-Setup', 'Frontend', 'Backend', 'DevOps'];
                        $selected = get('einsatzart', []);
                        foreach ($einsatzarten as $art): 
                        ?>
                            <label class="checkbox-label">
                                <input type="checkbox" name="einsatzart[]" value="<?= $art ?>" <?= in_array($art, $selected) ? 'checked' : '' ?>>
                                <span><?= $art ?></span>
                            </label>
                        <?php endforeach ?>
                    </div>
                </div>

                <div class="form-field">
                    <label for="technologien">Technologien / Stack (optional)</label>
                    <input type="text" id="technologien" name="technologien" value="<?= esc(get('technologien', '')) ?>" placeholder="z.B. PHP, React, Vue.js, WordPress, Kirby, Tailwind CSS">
                    <small class="field-hint">Kommagetrennt eingeben</small>
                </div>

                <div class="form-field">
                    <label for="beschreibung">Kurzbeschreibung / Briefing</label>
                    <textarea id="beschreibung" name="beschreibung" rows="6" required><?= esc(get('beschreibung', '')) ?></textarea>
                    <small class="field-hint">Beschreiben Sie kurz Ihr Projekt und die Anforderungen</small>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-prev" onclick="prevStep(1)">Zurück</button>
                    <button type="button" class="btn-next cta" onclick="nextStep(3)">Weiter</button>
                </div>
            </div>

            <!-- Stage 3: Kontaktdaten -->
            <div class="form-stage <?= $currentStep == 3 ? 'active' : '' ?>" data-stage="3">
                <h2 class="form-stage-title">Kontaktdaten</h2>
                
                <div class="form-field">
                    <label for="ansprechpartner">Ansprechpartner *</label>
                    <input type="text" id="ansprechpartner" name="ansprechpartner" value="<?= esc(get('ansprechpartner', '')) ?>" required>
                </div>

                <div class="form-field">
                    <label for="unternehmen">Unternehmen / Agentur</label>
                    <input type="text" id="unternehmen" name="unternehmen" value="<?= esc(get('unternehmen', '')) ?>">
                </div>

                <div class="form-field">
                    <label for="email">E-Mail-Adresse *</label>
                    <input type="email" id="email" name="email" value="<?= esc(get('email', '')) ?>" required>
                </div>

                <div class="form-field">
                    <label for="telefon">Telefonnummer (optional)</label>
                    <input type="tel" id="telefon" name="telefon" value="<?= esc(get('telefon', '')) ?>">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-prev" onclick="prevStep(2)">Zurück</button>
                    <button type="submit" name="submit" class="cta">Anfrage absenden</button>
                </div>
            </div>
        </form>
    <?php endif ?>
</article>

<script>
function nextStep(step) {
    // Validierung des aktuellen Steps
    const currentStage = document.querySelector('.form-stage.active');
    const requiredFields = currentStage.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            isValid = false;
            field.classList.add('error');
        } else {
            field.classList.remove('error');
        }
    });
    
    if (!isValid) {
        alert('Bitte füllen Sie alle Pflichtfelder aus.');
        return;
    }
    
    // Zum nächsten Step wechseln
    document.querySelectorAll('.form-stage').forEach(stage => {
        stage.classList.remove('active');
    });
    document.querySelector(`.form-stage[data-stage="${step}"]`).classList.add('active');
    
    // Fortschrittsanzeige aktualisieren
    document.querySelectorAll('.progress-step').forEach((stepEl, index) => {
        if (index < step - 1) {
            stepEl.classList.add('completed');
            stepEl.classList.remove('active');
        } else if (index === step - 1) {
            stepEl.classList.add('active');
            stepEl.classList.remove('completed');
        } else {
            stepEl.classList.remove('active', 'completed');
        }
    });
    
    // Hidden field aktualisieren
    document.querySelector('input[name="step"]').value = step;
    
    // Nach oben scrollen
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function prevStep(step) {
    nextStep(step);
}
</script>

<?php snippet('footer') ?>
