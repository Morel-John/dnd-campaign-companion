<?php if (!empty($races)): ?>
    <table border="1" style="width: 80%; border-collapse: collapse;">
        <thead>
            <tr>
                <th><?= t('Parentrace') ?></th>
                <th><?= t('Races') ?></th>
                <th><?= t('Book') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($races as $race): ?>
                <tr>
                    <td><?= e($race['parentracename'] ) ?></td>
                    <td><?= e($race['racename']) ?></td>
                    <td><?= e($race['bookId'] ?? 'Unknown') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="notice">
        <p>No more races...</p>
    </div>
<?php endif; ?>
</div>