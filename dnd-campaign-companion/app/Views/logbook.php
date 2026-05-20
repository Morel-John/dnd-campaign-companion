<script src="assets/js/page-flip.browser.js" defer></script>
<script src="assets/js/logbook.js" defer></script>

<link rel="stylesheet" href="assets/css/logbook.css">

<div id="book">
    <div class="page_cover" data-density="hard"></div>
    <?php if (!empty($logbooks)): ?>
        <?php foreach ($logbooks as $logbook): ?>
            <div class="page logbook_background">
                <div class="img-wrapper">
                    <img class="page_img" src="<?= e($logbook['image']) ?>" alt="Session Bild">
                </div>
                <div class="date-wrapper">
                    <?= date('d.m.Y', strtotime($logbook['date'])) ?>
                </div>
            </div>
            <div class="page logbook_background">
                <h3 class="log-title"><?= e($logbook['title']) ?></h3>
                <div class="story">
                    <p>
                    <?= nl2br(e($logbook['story'])) ?>
                    </p>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-entries">Noch keine Ereignisse in der Chronik verzeichnet.</p>
    <?php endif; ?>
    <div class="page_backcover" data-density="hard">
        <!-- Backcover -->
    </div>
</div>
<div class="logbook-header">
    <a href="index.php?page=logbook_form" class="btn-add">+ Neuer Eintrag</a>
</div>