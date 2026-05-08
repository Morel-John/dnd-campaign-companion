<?php if (!empty($quests)): ?>
    <table border="1" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th><?= t('Quest') ?></th>
                <th><?= t('Description') ?></th>
                <th><?= t('Quest giver') ?></th>
                <th><?= t('Town') ?></th>
                <th><?= t('Reward') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($quests as $quest): ?>
                <tr>
                    <td><strong><?= e($quest['questname']) ?></strong></td>
                    <td><?= e($quest['questdescription']) ?></td>
                    <td><?= e($quest['npcname'] ?? 'Unknown') ?></td>
                    <td><?= e($quest['townname'] ?? 'Town') ?></td>
                    <td><em><?= e($quest['reward']) ?></em></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="notice">
        <p>Momentan sind keine Quests verfügbar. Die Taverne ist leer gefegt!</p>
    </div>
<?php endif; ?>
</div>