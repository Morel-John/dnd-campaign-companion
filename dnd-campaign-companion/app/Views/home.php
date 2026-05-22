<script src="assets/js/npc_search.js" defer></script>
<script src="assets/js/npc_profile.js" defer></script>

<div class="search-container">
    <input type="text" id="searchInput" placeholder="<?= t('search_placeholder') ?>">
</div>

<div class="npc-grid">
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
                data-size="<?= e($npc['sizename'] ?? '') ?>">
                <div class="card-image-container">
                    <span><img class="card-image" src="<?= e($npc['image'] ?? BASE_PATH . '/public/assets/img/npc/default.png') ?>"> </span>
                </div>
                <h3 class="card-name"><?= e($npc['npcname'])  ?></h3>

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