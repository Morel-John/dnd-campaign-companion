<?php
require '../config/lang_function.php';
require '../config/helpers.php';
?>

<!DOCTYPE html>
<html lang="$current_lang">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D&D Campaign Companion</title>

    <!-- TODO: Styles noch auslagern und optimieren -->
    <style>
        nav {
            background: #2c3e50;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .lang-switch {
            font-size: 0.8rem;
        }
    </style>
</head>

<body>
    <nav>
        <div class="menu">
            <a href="index.php?page=home"><?= t('nav_home') ?></a>
            <a href="index.php?page=npc_form"><?= t('nav_new_npc') ?></a>
            <a href="index.php?page=quest_list"><?= t('nav_quests') ?></a>
            <a href="index.php?page=race_detail"><?= t('nav_races') ?></a>
            <a href="index.php?page=logbook"><?= t('nav_logbook') ?></a>
        </div>

        <div class="lang-switch">
            <a href="?lang=de">DE</a> | <a href="?lang=en">EN</a>
        </div>
    </nav>

</body>

</html>