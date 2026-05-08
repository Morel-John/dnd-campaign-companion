<?php

/** * Definiert die "Home Base" des Projekts. 
 * Ermöglicht sichere Dateizugriffe auf /src, /config und /templates, 
 * ohne mühsame "../" Pfade nutzen zu müssen.
 */
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/app/config/database_connection.php';

# Required models 
require_once BASE_PATH . '/app/Models/Alignments.php';
require_once BASE_PATH . '/app/Models/Classes.php';
require_once BASE_PATH . '/app/Models/Npcs.php';
require_once BASE_PATH . '/app/Models/Parentraces.php';
require_once BASE_PATH . '/app/Models/Professions.php';
require_once BASE_PATH . '/app/Models/Quests.php';
require_once BASE_PATH . '/app/Models/Races.php';
require_once BASE_PATH . '/app/Models/Sizes.php';
require_once BASE_PATH . '/app/Models/Status.php';
require_once BASE_PATH . '/app/Models/Towns.php';

# Save current page in variable
$page = $_GET['page'] ?? 'home';

require_once BASE_PATH . '/app/Views//header.php';

# Use page-variable to look what has to be loaded
switch ($page) {
  case 'home':
    $npcs = Npcs::getAll($pdo);
    require BASE_PATH . '/app/Views/home.php';
    break;

  case 'npc_form':
    $selectedTown = 1;
    $selectedParent = 1;
    $selectedClass = 1;
    $selectedProfession = 1;
    $selectedStatus = 1;
    $selectedSizeId = 1;

    $parent_races = Parentraces::getAllParenraces($pdo);
    $towns = Towns::getAll($pdo);
    $classes = Classes::getAll($pdo);
    $professions = Profession::getAll($pdo);
    $alignments = Alignment::getAll($pdo);
    $status = Status::getAllNpcStatus($pdo);
    $sizes = Sizes::getAll($pdo);
    $information = Npcs::getInfo($pdo);
    require BASE_PATH . '/app/Views/npc_form.php';
    break;

  case 'quest_list':
    $quests = Quests::getAll($pdo);
    require BASE_PATH . '/app/Views/quest_list.php';
    break;

  case 'race_detail':
    $races = Races::getAllRaces($pdo);
    require BASE_PATH . '/app/Views/race_detail.php';
    break;

  case 'logbook':
    require BASE_PATH . '/app/Views/logbook.php';
    break;

  default:
    echo "<h1> 404 - Dungeon not found!</h1>";
}
