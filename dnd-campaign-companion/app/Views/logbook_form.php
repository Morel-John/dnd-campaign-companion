<?php
// Entscheiden, ob wir speichern oder updaten
$formAction = isset($logbook) ? 'logbook_update' : 'logbook_save';
?>

<h2 class="form-title">📜 Chronik der Ereignisse</h2>

<div class="logbook-form-container">

    <form method="POST" action="index.php?page=logbook_form&action=<?= $formAction ?>" enctype="multipart/form-data">

        <?php if (isset($logbook)): ?>
            <input type="hidden" name="logbookId" value="<?= e($logbook['logbookId']) ?>">
            <input type="hidden" name="current_image" value="<?= e($logbook['image'] ?? 'assets/img/logbook/default.jpg') ?>">
        <?php endif; ?>

        <label class="form-label">Titel des Abenteuers / Ereignisses</label>
        <input type="text" name="title" class="form-input"
            value="<?= e($logbook['title'] ?? '') ?>"
            placeholder="z.B. Die Schlacht am Düsterwald" required>

        <label class="form-label">Datum des Ereignisses</label>
        <input type="date" name="date" class="form-input"
            value="<?= e($logbook['date'] ?? date('Y-m-d')) ?>" required>

        <label class="form-label">Logbuch-Eintrag</label>
        <textarea name="story" class="form-textarea" rows="12"
            placeholder="Was ist geschehen?..." required><?= e($logbook['story'] ?? '') ?></textarea>

        <label class="form-label">Illustratives Bild (optional)</label>

        <?php if (isset($logbook) && $logbook['image']): ?>
            <div class="current-image-preview">
                <img src="<?= e($logbook['image']) ?>" alt="Aktuelles Bild">
                <p>Aktuell versiegeltes Bild</p>
            </div>
        <?php endif; ?>

        <input type="file" name="image" class="form-file" accept="image/*">

        <hr class="form-divider">

        <div class="form-buttons">
            <button type="submit" class="btn-save">
                <?= isset($logbook) ? 'Eintrag versiegeln (Update)' : 'In Chronik einschreiben' ?>
            </button>

            <a href="index.php?page=logbook" class="btn-cancel">Abbrechen</a>
        </div>

    </form>
</div>