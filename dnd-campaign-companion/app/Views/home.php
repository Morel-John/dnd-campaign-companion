<script src="assets/js/npc_search.js" defer></script>
<script src="assets/js/npc_profile.js" defer></script>

<div class="search-bar" style="margin: 20px 0;">
    <input type="text" id="searchInput" placeholder="<?= t('search_placeholder') ?>" style="width: 100%; padding: 10px;">
</div>

<div class="npc-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(150px, 1fr)); gap: 20px;">

    <?php if (empty($npcs)): ?>
        <p>Keine NPCs gefunden. Zeit, welche zu erschaffen!</p>
    <?php else: ?>
        <?php foreach ($npcs as $npc): ?>
            <div class="npc-card"
                data-search="<?= e(strtolower(
                                    $npc['npcname'] . ' '
                                        . $npc['townname'] . ' '
                                        . $npc['classname'] . ' '
                                        . $npc['professionname'] . ' '
                                        . $npc['parentracename'] . ' '
                                        . $npc['alignmentname'] . ' '
                                        . $npc['statusname'] . ' '
                                        . $npc['sizename']
                                )) ?>"
                data-id="<?= e($npc['npcId']) ?>"
                data-name="<?= e($npc['npcname'] ?? '') ?>"
                data-town="<?= e($npc['townname'] ?? '') ?>"
                data-class="<?= e($npc['classname'] ?? '') ?>"
                data-profession="<?= e($npc['professionname'] ?? '') ?>"
                data-parentrace="<?= e($npc['parentracename'] ?? '') ?>"
                data-alignment="<?= e($npc['alignmentname'] ?? '') ?>"
                data-status="<?= e($npc['statusname'] ?? '') ?>"
                data-image="<?= !empty($npc['image']) ? e($npc['image']) : 'assets/img/npc/default.png' ?>"
                data-size="<?= e($npc['sizename'] ?? '') ?>"
                style="border: 1px solid #ccc; padding: 10px; text-align: center; border-radius: 8px;">
                <div class="image-placeholder">
                    <span style="font-size: 2rem;"><img style="width:50px" src="<?= e($npc['image'] ?? BASE_PATH . '/public/assets/img/npc/default.png') ?>"> </span>
                </div>
                <strong style="display: block; margin-bottom: 5px;">
                    <?= e($npc['npcname']) ?>
                </strong>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</div>

<!-- Building npcModal for detailed portrait -->
<div id="npcModal" class="modal">
    <div class="modal-content">
        <!-- Using 8times to generated x as closebutton -->
        <span class="closeButton">&times;</span>

        <div class="modal-header">
            <div class="modal-image-container">
                <img id="modal-image" src="" alt="NPC Bild">
            </div>
            <h2 id="modal-name">NPC name</h2>
        </div>

        <div class="modal-stats">
            <p><strong>Town:</strong> <span id="modal-town"></span></p>
            <p><strong>Size:</strong> <span id="modal-size"></span></p>
            <p><strong>Race:</strong> <span id="modal-race"></span></p>
            <p><strong>Profession:</strong> <span id="modal-profession"></span></p>
            <p><strong>Alignment:</strong> <span id="modal-alignment"></span></p>
            <p><strong>Status:</strong> <span id="modal-status"></span></p>
        </div>

        <div class="modal-body">
            <h3>Information</h3>
            <p id="modal-info"></p>

            <div class="modal-footer">
                <a id="modal-edit-btn" href="#" class="btn-edit-profile">Edit NPC</a>
            </div>
        </div>

    </div>
</div>