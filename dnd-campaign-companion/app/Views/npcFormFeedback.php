<?php
// app/Views/feedback.php
$status = $_GET['status'] ?? '';
$isError = ($status === 'failed');
require_once BASE_PATH . '/app/config/database_connection.php';
?>
<!-- ####### To-Do: optimize site #####  -->
 <!-- ############################################# -->
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
        case 'successdelete': ?>
            <h2>🎉 Sad!</h2>
            <p>Der NPC wurde erfolgreich aus dieser Welt eliminiert.</p>
        <?php break;
        case 'errordelete': ?>
            <h2>💀 Kritischer Fehlschlag!</h2>
            <p>Die Götter wollen sich nicht verabschieden.</p>
        <?php break;
        case 'successquest': ?>
            <h2>🎉 Sieg!</h2>
            <p>Der Quest wurde erfolgreich in die Chroniken eingetragen.</p>
        <?php break;
        case 'errorquest': ?>
            <h2>💀 Kritischer Fehlschlag!</h2>
            <p>Die Götter (oder die Datenbank) haben die Quest abgelehnt.</p>
        <?php break;
        case 'successstory': ?>
            <h2>🎉 Sieg!</h2>
            <p>Der session wurde erfolgreich in die Chroniken eingetragen.</p>
        <?php break;
        case 'errorstory': ?>
            <h2>💀 Kritischer Fehlschlag!</h2>
            <p>Die Götter (oder die Datenbank) haben die session abgelehnt.</p>
        <?php break;
        case 'successStoryUpdate': ?>
            <h2>🎉 Sieg!</h2>
            <p>Der session wurde erfolgreich in die Chroniken eingetragen.</p>
        <?php break;
        case 'errorStoryUpdate': ?>
            <h2>💀 Kritischer Fehlschlag!</h2>
            <p>Die Götter (oder die Datenbank) haben die session abgelehnt.</p>
        <?php break;
        case 'successStoryDelete': ?>
            <h2>🎉 Sieg!</h2>
            <p>Der session wurde erfolgreich in die Chroniken eingetragen.</p>
        <?php break;
        case 'errorStoryDelete': ?>
            <h2>💀 Kritischer Fehlschlag!</h2>
            <p>Die Götter (oder die Datenbank) haben die session abgelehnt.</p>
    <?php break;
    } ?>

    <a href="index.php?page=home" class="btn">Zurück zur Übersicht</a>
    <a href="index.php?page=npc_form" class="btn">Noch einen NPC erstellen</a>
</div>