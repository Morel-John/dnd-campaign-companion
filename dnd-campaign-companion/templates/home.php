<div class="search-bar" style="margin: 20px 0;">
    <input type="text" placeholder="<?= t('search_placeholder') ?>" style="width: 100%; padding: 10px;">
</div>

<div class="npc-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 20px;">

    <?php if (empty($npcs)): ?>
        <p>Keine NPCs gefunden. Zeit, welche zu erschaffen!</p>
    <?php else: ?>
        <?php foreach ($npcs as $npc): ?>
            <div class="npc-card" style="border: 1px solid #ccc; padding: 10px; text-align: center; border-radius: 8px;">
                <div class="image-placeholder">
                    <span style="font-size: 2rem;"><img style="width:50px" src="<?= e($npc['image'] ?? '../public/assets/img/npc/default.png') ?>" </span>
                </div>
                <strong style="display: block; margin-bottom: 5px;">
                    <?= e($npc['npcname']) ?>
                </strong>

            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>