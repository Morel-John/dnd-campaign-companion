    <div>
        <h2 style="text-align:center;">Neuen NPC in die Archive eintragen</h2>

        <form method="POST" action="index.php?page=npc_form&action=npc_save" style="display: flex; flex-direction: column; gap: 15px;">

            <label>Name</label>
            <input type="text" name="npcname" required style="padding: 10px;">

            <!-- Dropdown menu -->
            <label>Race</label>
            <select name="parentraceId" id="parentrace" style="padding: 10px;">
                <!-- Safety check: Catch error before it happens  -->
                <?php if (!empty($parent_races)): ?>
                    <!-- Reading all information of pre-saved variable ($parent_races) with foreach -->
                    <?php foreach ($parent_races as $parent_race): ?>
                        <!-- Giving value information: "$parent_race['parentraceId']" to php (invisible for user).
                             Default setting for the form ("Unknown") Gets information from index.php ($selectedParent).
                             If Id is not found leave empty.
                             What is actually shown in the dropdown menu. 
                        -->
                        <option
                            value="<?= e($parent_race['parentraceId']) ?>"
                            <?= ($parent_race['parentraceId'] == $selectedParent) ? 'selected' : '' ?>>
                            <?= e($parent_race['parentracename']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <!-- What happens when something went wrong with the database_connection -->
                    <option value="" disabled selected>No Race found!</option>
                <?php endif; ?>
            </select>

            <!-- Dropdown menu -->
            <label>Town</label>
            <select name="townId" id="town" style="padding: 10px;">
                <?php if (!empty($towns)):
                    foreach ($towns as $town): ?>
                        <option
                            value="<?= e($town['townId']) ?>"
                            <?= ($town['townId'] == $selectedTown) ? 'selected' : '' ?>>
                            <?= e($town['townname']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled selected>No town found!</option>
                <?php endif; ?>
            </select>

            <!-- Dropdown menu -->
            <label>Class</label>
            <select name="classId" id="class" style="padding: 10px;">
                <?php if (!empty($classes)): ?>
                    <?php foreach ($classes as $class): ?>
                        <option
                            value="<?= e($class['classId']) ?>"
                            <?= ($class['classId'] == $selectedClass) ? 'selected' : '' ?>>
                            <?= e($class['classname']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled selected>No class found!</option>
                <?php endif; ?>
            </select>

            <!-- Dropdown menu -->
            <label>Profession</label>
            <select name="professionId" id="profession" style="padding: 10px">
                <?php if (!empty($professions)): ?>
                    <?php foreach ($professions as $profession): ?>
                        <option
                            value="<?= e($profession['professionId']) ?>"
                            <?= ($profession['professionId'] == $selectedProfession) ? 'selected' : '' ?>>
                            <?= e($profession['professionname']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled selected>No profession found!</option>
                <?php endif; ?>
            </select>

            <!-- Radio Button -->
            <label>Alignment</label>
            <!-- Safety check: Catch error before it happens  -->
            <?php if (!empty($alignments)): ?>
                <!-- Reading all information of pre-saved variable ($parent_races) with foreach -->
                <?php foreach ($alignments as $alignment): ?>
                    <div class="radio-item">
                        <!-- Clarify id with attaching alignmentId with ("align_"+alignmentId)
                        Giving value information: "$alignments['alignmentId']" to php (invisible for user).
                        Giving label based on Id like in id="align_"...
                        What is actually shown as radio button. -->
                        <input
                            type="radio"
                            name="alignmentId"
                            id="align_<?= e($alignment['alignmentId']) ?>"
                            value="<?= e($alignment['alignmentId']) ?>"
                            <?= ($alignment['alignmentId'] == ($selectedAlignmentId ?? 1)) ? 'checked' : '' ?>>
                        <label for="align_<?= e($alignment['alignmentId']) ?>">
                            <?= e($alignment['alignmentname']) ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <!-- What happens when something went wrong with the database_connection -->
                <p>Where did the alignments go?</p>
            <?php endif; ?>

            <!-- Radio Button -->
            <label>Status</label>
            <?php if (!empty($status)): ?>
                <?php foreach ($status as $statu): ?>
                    <div class="radio-item">
                        <input
                            type="radio"
                            name="statusId"
                            id="status_<?= e($statu['statusId']) ?>"
                            value="<?= e($statu['statusId']) ?>"
                            <?= ($statu['statusId'] == ($selectedStatusId ?? 1)) ? 'checked' : '' ?>>
                        <label for="status_<?= e($statu['statusId']) ?>">
                            <?= e($statu['statusname']) ?>
                        </label>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Where did the alignments go?</p>
            <?php endif; ?>

            <!-- Radio Button -->
            <label>Size</label>
            <?php if (!empty($sizes)): ?>
                <div class="radio-grid">
                    <?php foreach ($sizes as $size): ?>
                        <div class="size-item">
                            <input
                                type="radio"
                                name="sizeId"
                                id="size_<?= e($size['sizeId']) ?>"
                                value="<?= e($size['sizeId']) ?>"
                                class="hidden-radio"
                                <?= ($size['sizeId'] == ($selectedSizeId ?? 1)) ? 'checked' : '' ?>>
                            <label for="size_<?= e($size['sizeId']) ?>" class="box-label">
                                <img src="<?= e($size['image']) ?>" alt="<?= e($size['sizename']) ?>">
                                <span><?= e($size['sizename']) ?></span>
                            </label>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Where did the alignments go?</p>
            <?php endif; ?>

            <!-- Textfield -->
            <label for="information">Information</label>
            <textarea id="information" name="information" rows="8" cols="20">-- Enter informations here --</textarea>

            <!-- Upload -->
            <label>Uploead picture</label>
            <input type="file" name="image" accept="image/png, image/jpeg, image/jpg" style="padding: 10px; border: 1px solid #8d6e63;">
            
            <!-- Submit Button -->
            <div>
                <button type="submit" style="text-align:center">Submit changes</button>
            </div>
            
            <!-- Discard Button -->
            <div>
                <a id="edit-btn" href="index.php?page=home" style="text-align:center" >Discard changes</a>
            </div>
        </form>