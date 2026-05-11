<?php
// app/Views/feedback.php
$type = $_GET['status'] ?? '';
$isError = str_contains($type, 'failed');
require_once BASE_PATH . '/app/config/database_connection.php';
?>
<!-- ####### To-Do: optimize site #####  -->
<div class="feedback-container <?= $isError ? 'error' : 'success' ?>">
    <?php if ($type === 'success'): ?>
        <h2>🎉 Sieg!</h2>
        <p>Der NPC wurde erfolgreich in die Chroniken eingetragen.</p>
    <?php elseif ($type === 'error'): ?>
        <h2>💀 Kritischer Fehlschlag!</h2>
        <p>Die Götter (oder die Datenbank) haben den Eintrag abgelehnt.</p>
    <?php endif; ?>

    <a href="index.php?page=home" class="btn">Zurück zur Übersicht</a>
    <a href="index.php?page=npc_form" class="btn">Noch einen NPC erstellen</a>
</div>