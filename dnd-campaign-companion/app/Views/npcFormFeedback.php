<?php
// app/Views/feedback.php
$status = $_GET['status'] ?? '';
$isError = ($status === 'failed');
require_once BASE_PATH . '/app/config/database_connection.php';
?>
<!-- ####### To-Do: optimize site #####  -->
<div class="feedback-container <?= $isError ? 'error' : 'success' ?>">
    <?php switch ($status) {
        case 'success': ?>
            <h2>🎉 Sieg!</h2>
            <p>Der NPC wurde erfolgreich in die Chroniken eingetragen.</p>
        <?php break;
        case 'error': ?>
            <h2>💀 Kritischer Fehlschlag!</h2>
            <p>Die Götter (oder die Datenbank) haben den Eintrag abgelehnt.</p>
        <?php break;
        case 'successupdate': ?>
            <h2>🎉 Sieg!</h2>
            <p>Der NPC wurde erfolgreich neugeformt.</p>
        <?php break;

        case 'errorupdate': ?>
            <h2>💀 Kritischer Fehlschlag!</h2>
            <p>Die Götter (oder die Datenbank) haben die Änderung abgelehnt.</p>
    <?php break;
    } ?>

    <a href="index.php?page=home" class="btn">Zurück zur Übersicht</a>
    <a href="index.php?page=npc_form" class="btn">Noch einen NPC erstellen</a>
</div>