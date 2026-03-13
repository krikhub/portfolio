<?php
/**
 * Website-Projekt Anfrage Template - 3-stufiges Formular
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
                $emailBody = "Neue Website-Projekt Anfrage\n\n";
                $emailBody .= "=== PROJEKTDETAILS ===\n";
                $emailBody .= "Projektname: " . ($data['projektname'] ?? '-') . "\n";
                $emailBody .= "Ziel des Projekts:\n" . ($data['projektziel'] ?? '-') . "\n\n";
                $emailBody .= "CMS-Wunsch: " . ($data['cms_wunsch'] ?? '-') . "\n";
                $emailBody .= "Website-Typ: " . ($data['website_typ'] ?? '-') . "\n\n";
                
                $emailBody .= "=== INHALTE & FUNKTIONALITÄT ===\n";
                $emailBody .= "Benötigte Features: " . (isset($data['features']) ? implode(', ', $data['features']) : '-') . "\n";
                $emailBody .= "Individuelle Funktionen: " . ($data['individuelle_funktionen'] ?? '-') . "\n";
                $emailBody .= "Design-Vorgaben:\n" . ($data['design_vorgaben'] ?? '-') . "\n\n";
                
                $emailBody .= "=== KONTAKTDATEN ===\n";
                $emailBody .= "Ansprechpartner: " . $data['ansprechpartner'] . "\n";
                $emailBody .= "Unternehmen: " . ($data['unternehmen'] ?? '-') . "\n";
                $emailBody .= "E-Mail: " . $data['email'] . "\n";
                $emailBody .= "Telefon: " . ($data['telefon'] ?? '-') . "\n";
                $emailBody .= "Besondere Hinweise:\n" . ($data['hinweise'] ?? '-') . "\n";
                
                // Prüfe ob wir lokal sind
                $isLocal = in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1']) || 
                           strpos($_SERVER['HTTP_HOST'], 'localhost:') === 0 ||
                           strpos($_SERVER['HTTP_HOST'], '.local') !== false;
                
                if ($isLocal) {
                    // Lokal: Speichere in Datei
                    $logDir = kirby()->root('site') . '/logs';
                    if (!is_dir($logDir)) {
                        mkdir($logDir, 0755, true);
                    }
                    $logFile = $logDir . '/website-projekt-anfragen.log';
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
                        'subject' => 'Neue Website-Projekt Anfrage: ' . ($data['projektname'] ?? 'Ohne Projektnamen'),
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
        <h1><?= $page->headline()->or('Website-Projekt anfragen') ?></h1>
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
                <p><small style="color: var(--color-grey);">Hinweis: Lokal wurde die Anfrage in site/logs/website-projekt-anfragen.log gespeichert.</small></p>
            <?php endif ?>
            <a href="<?= $site->url() ?>" class="cta margin-l">Zurück zur Startseite</a>
        </div>
    <?php else: ?>
        
        <!-- Fortschrittsanzeige -->
        <div class="form-progress">
            <div class="progress-steps">
                <div class="progress-step <?= $currentStep >= 1 ? 'active' : '' ?> <?= $currentStep > 1 ? 'completed' : '' ?>">
                    <span class="step-number">1</span>
                    <span class="step-label">Projektdetails</span>
                </div>
                <div class="progress-step <?= $currentStep >= 2 ? 'active' : '' ?> <?= $currentStep > 2 ? 'completed' : '' ?>">
                    <span class="step-number">2</span>
                    <span class="step-label">Inhalte & Funktionen</span>
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
            
            <!-- Stage 1: Projektdetails -->
            <div class="form-stage <?= $currentStep == 1 ? 'active' : '' ?>" data-stage="1">
                <h2 class="form-stage-title">Projektdetails</h2>
                
                <div class="form-field">
                    <label for="projektname">Projektname / Website-Titel</label>
                    <input type="text" id="projektname" name="projektname" value="<?= esc(get('projektname', '')) ?>" required>
                </div>

                <div class="form-field">
                    <label for="projektziel">Ziel des Projekts</label>
                    <textarea id="projektziel" name="projektziel" rows="4" required><?= esc(get('projektziel', '')) ?></textarea>
                    <small class="field-hint">z.B. "Neue Firmenwebsite", "Landingpage für Produkt"</small>
                </div>

                <div class="form-field">
                    <label for="cms_wunsch">CMS-Wunsch</label>
                    <select id="cms_wunsch" name="cms_wunsch" required>
                        <option value="">Bitte wählen</option>
                        <option value="WordPress" <?= get('cms_wunsch', '') == 'WordPress' ? 'selected' : '' ?>>WordPress</option>
                        <option value="Statamic" <?= get('cms_wunsch', '') == 'Statamic' ? 'selected' : '' ?>>Statamic</option>
                        <option value="Kirby" <?= get('cms_wunsch', '') == 'Kirby' ? 'selected' : '' ?>>Kirby</option>
                        <option value="Andere" <?= get('cms_wunsch', '') == 'Andere' ? 'selected' : '' ?>>Andere</option>
                        <option value="Keine Präferenz" <?= get('cms_wunsch', '') == 'Keine Präferenz' ? 'selected' : '' ?>>Keine Präferenz</option>
                    </select>
                </div>

                <div class="form-field">
                    <label for="website_typ">Website-Typ</label>
                    <select id="website_typ" name="website_typ" required>
                        <option value="">Bitte wählen</option>
                        <option value="Onepager / Landingpage" <?= get('website_typ', '') == 'Onepager / Landingpage' ? 'selected' : '' ?>>Onepager / Landingpage</option>
                        <option value="Unternehmenswebsite" <?= get('website_typ', '') == 'Unternehmenswebsite' ? 'selected' : '' ?>>Unternehmenswebsite</option>
                        <option value="Webshop / E-Commerce" <?= get('website_typ', '') == 'Webshop / E-Commerce' ? 'selected' : '' ?>>Webshop / E-Commerce</option>
                        <option value="Individuelle Webanwendung" <?= get('website_typ', '') == 'Individuelle Webanwendung' ? 'selected' : '' ?>>Individuelle Webanwendung</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn-next cta" onclick="nextStep(2)">Weiter</button>
                </div>
            </div>

            <!-- Stage 2: Inhalte & Funktionalität -->
            <div class="form-stage <?= $currentStep == 2 ? 'active' : '' ?>" data-stage="2">
                <h2 class="form-stage-title">Inhalte & Funktionalität</h2>
                
                <div class="form-field">
                    <label>Benötigte Features (Mehrfachauswahl möglich)</label>
                    <div class="checkbox-group">
                        <?php 
                        $features = ['Kontaktformular', 'Blog / Newsbereich', 'E-Commerce / Shop', 'Mehrsprachigkeit', 'Newsletter / Mailing'];
                        $selected_features = get('features', []);
                        foreach ($features as $feature): 
                        ?>
                            <label class="checkbox-label">
                                <input type="checkbox" name="features[]" value="<?= $feature ?>" <?= in_array($feature, $selected_features) ? 'checked' : '' ?>>
                                <span><?= $feature ?></span>
                            </label>
                        <?php endforeach ?>
                    </div>
                </div>

                <div class="form-field">
                    <label for="individuelle_funktionen">Individuelle Funktionen (optional)</label>
                    <input type="text" id="individuelle_funktionen" name="individuelle_funktionen" value="<?= esc(get('individuelle_funktionen', '')) ?>" placeholder="z.B. Buchungssystem, Mitgliederbereich">
                </div>

                <div class="form-field">
                    <label for="design_vorgaben">Design-Vorgaben / Beispiele</label>
                    <textarea id="design_vorgaben" name="design_vorgaben" rows="6"><?= esc(get('design_vorgaben', '')) ?></textarea>
                    <small class="field-hint">z.B. "Corporate Design beachten", Links zu Beispiel-Websites, Beschreibung des gewünschten Stils</small>
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

                <div class="form-field">
                    <label for="hinweise">Besondere Hinweise / Fragen (optional)</label>
                    <textarea id="hinweise" name="hinweise" rows="4"><?= esc(get('hinweise', '')) ?></textarea>
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
    
    document.querySelectorAll('.form-stage').forEach(stage => {
        stage.classList.remove('active');
    });
    document.querySelector(`.form-stage[data-stage="${step}"]`).classList.add('active');
    
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
    
    document.querySelector('input[name="step"]').value = step;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function prevStep(step) {
    nextStep(step);
}
</script>

<?php snippet('footer') ?>
