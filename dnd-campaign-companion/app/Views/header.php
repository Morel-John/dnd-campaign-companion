<!DOCTYPE html>
<html lang="$current_lang">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&D Campaign Companion</title>
    <link rel="stylesheet" href="assets/CSS/main.css">
</head>

<body>
    <nav class="dungeon-navbar">
        <span class="nav-breaker">
        </span>
        <div class="nav-brand">
            <span class="brand-logo">⚔️</span>
        </div>

        <ul class="nav-links">
            <li><a href="index.php?page=home" class="active"><?= t('nav_home') ?></a></li>
            <li class="divider">ᚠ</li>
            <li><a href="index.php?page=npc_form"><?= t('nav_new_npc') ?></a></li>
            <li class="divider">ᚠ</li>
            <li><a href="index.php?page=quest_list"><?= t('nav_quests') ?></a></li>
            <li class="divider">ᚠ</li>
            <li><a href="index.php?page=race_detail"><?= t('nav_races') ?></a></li>
            <li class="divider">ᚠ</li>
            <li><a href="index.php?page=logbook"><?= t('nav_logbook') ?></a></li>
            <li class="divider">ᚠ</li>
            <li><a href="index.php?page=logbook_form"><?= t('nav_logbook_form') ?></a></li>
        </ul>

        <div class="nav-user">
            <a href="#profile" class="user-icon" style="color: #b5b5b5; font-size: 0.7rem;">👤<?= e($_SESSION['username']) ?></a>
            <a href="#settings" class="settings-icon">⚙️</a>
            <div class="lang-switch">
                <a href="?lang=de">DE</a> | <a href="?lang=en">EN</a>
            </div>
            <a href="index.php?action=logout"
                style="background-color: #ff3860; padding: 6px 12px; border-radius: 4px; color: white; text-decoration: none; font-size: 0.9rem;">
                Logout
            </a>
        </div>
    </nav>
    <span class="nav-breaker">

    </span>
</body>

</html>