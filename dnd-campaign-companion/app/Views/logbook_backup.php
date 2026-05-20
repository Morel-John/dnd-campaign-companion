

    <div class="logbook-container">
        <?php if (!empty($logbooks)): ?>
            <?php foreach ($logbooks as $logbook): ?>
                <article class="log-entry">

                    <div class="log-image">
                        <img src="<?= e($logbook['image']) ?>" alt="Session Bild">
                    </div>

                    <div class="log-content">
                        <div class="log-meta">
                            <span class="log-date">
                                📅 <?= date('d.m.Y', strtotime($logbook['date'])) ?>
                            </span>
                            <div class="log-actions">
                                <!-- Since its just for read i dont need a form. Else if i reload the page it will request to send to POST again -->
                                <!-- <form method="POST" action="index.php?page=logbook_form&id=<?= $logbook['logbookId'] ?>">
                                    <input type="hidden" name="id" value="<?= e($logbook['logbookId']) ?>">
                                    <button type="submit">Edit</button>
                                </form> -->
                                <a href="index.php?page=logbook_form&id=<?= e($logbook['logbookId']) ?>">Edit</a>
                                <form method="POST" action="index.php?action=logbook_delete">
                                    <input type="hidden" name="id" value="<?= e($logbook['logbookId']) ?>">
                                    <button type="submit">Löschen</button>
                                </form>
                            </div>
                        </div>

                        <h3 class="log-title"><?= e($logbook['title']) ?></h3>

                        <p class="log-text">
                            <?= nl2br(e(mb_strimwidth($logbook['story'], 0, 250, "..."))) ?>
                        </p>

                        <div class="log-footer">
                            <a href="index.php?page=logbook_detail&id=<?= $logbook['logbookId'] ?>" class="read-more">
                                Vollständigen Bericht lesen →
                            </a>
                        </div>
                    </div>

                </article>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="no-entries">Noch keine Ereignisse in der Chronik verzeichnet.</p>
        <?php endif; ?>

    </div>