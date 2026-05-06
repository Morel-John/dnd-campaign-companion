    <div>
        <h2 style="text-align:center;">Neuen NPC in die Archive eintragen</h2>

        <form method="POST" action="" style="display: flex; flex-direction: column; gap: 15px;">

            <label>Name of NPC:</label>
            <input type="text" name="npcname" required style="padding: 10px;">

            <!-- Dropdown menu -->
            <label>Race</label>
            <select name="parentraceId" id="parentrace" required style="padding: 10px;">
                <?php if (!empty($parent_races)): ?>
                    <?php foreach ($parent_races as $parent_race): ?>
                        <option value="<?= e($parent_race['parentraceId']) ?>" <?= ($parent_race['parentraceId'] == $selectedParent) ? 'selected' : '' ?>>
                            <?= e($parent_race['parentracename']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled selected>No Race found!</option>;
                <?php endif; ?>
            </select>

            <!-- Dropdown menu -->
            <label>Town</label>
            <select name="townId" id="town" required style="padding: 10px;">
                <?php if (!empty($towns)): 
                     foreach ($towns as $town): ?>
                        <option value=" <?= e($town['townId']) ?>" <?= ($town['townId'] == $selectedTown) ? 'selected' : '' ?>>
                            <?= e($town['townname']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled selected>No town found!</option>;
                <?php endif; ?>
            </select>

            <!-- Dropdown menu -->
            <label>Class</label>
            <select name="classId" id="class" required style="padding: 10px;">
                <?php if (!empty($classes)): ?>
                    <?php foreach ($classes as $class): ?>
                        <option value=" <?= e($class['classId']) ?>" <?= ($class['classId'] == $selectedClass) ? 'selected' : '' ?>>
                            <?= e($class['classname']) ?>
                        </option>
                    <?php endforeach; ?>
                <?php else: ?>
                    <option value="" disabled selected>No class found!</option>;
                <?php endif; ?>
            </select>
        </form>