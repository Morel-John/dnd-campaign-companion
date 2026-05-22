<?php
## Saving current page in variable
$currentPage = isset($_GET['page']) ? $_GET['page'] : 'home';
## Helper function to determine if a nav link is active
function isActive($pageName, $currentPage)
{
    return $pageName === $currentPage ? 'active' : '';
}
?>
<!DOCTYPE html>
<html lang="$current_lang">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&D Campaign Companion</title>
    <link rel="stylesheet" href="assets/CSS/main.css">
</head>

<body>
    <nav class="nav">
        <div class="nav-brand">
        </div>

        <ul class="nav-links">
            <!-- Navigation Links; using isActive function and translation function-->
            <li><a href="index.php?page=home" class="<?= isActive('home', $currentPage) ?>"><?= t('nav_home') ?></a></li>
            <li class="divider">🛡️</li>
            <li><a href="index.php?page=npc_form" class="<?= isActive('npc_form', $currentPage) ?>"><?= t('nav_new_npc') ?></a></li>
            <li class="divider">🛡️</li>
            <li><a href="index.php?page=quest_list" class="<?= isActive('quest_list', $currentPage) ?>"><?= t('nav_quests') ?></a></li>
            <li class="divider">🛡️</li>
            <li><a href="index.php?page=race_detail" class="<?= isActive('race_detail', $currentPage) ?>"><?= t('nav_races') ?></a></li>
            <li class="divider">🛡️</li>
            <li><a href="index.php?page=logbook" class="<?= isActive('logbook', $currentPage) ?>"><?= t('nav_logbook') ?></a></li>
            <li class="divider">🛡️</li>
            <li><a href="index.php?page=logbook_form" class="<?= isActive('logbook_form', $currentPage) ?>"><?= t('nav_logbook_form') ?></a></li>
        </ul>

        <div class="nav-user">
            <!-- <div class="settings-container">
                <input type="checkbox" id="settings-toggle" class="settings-toggle-checkbox">

                <label for="settings-toggle" class="settings-burger">
                    <span></span>
                    <span></span>
                    <span></span>
                </label>

                <div class="settings-dropdown">
                    <div class="dropdown-user-info">
                        👤 <?= e($_SESSION['username']) ?>
                    </div>
                    <div class="dropdown-divider"></div>
                    <div class="dropdown-label">Sprache / Language</div>
                    <div class="dropdown-lang-switch">
                        <a href="?lang=de" class="<?= 'de' ? 'active-lang' : '' ?>">DE</a>
                        <span>|</span>
                        <a href="?lang=en" class="<?= 'en' ? 'active-lang' : '' ?>">EN</a>
                    </div>
                </div>
            </div> -->

            <a href="index.php?action=logout" class="logout-btn">
                Logout
            </a>
        </div>
    </nav>
</body>

</html>