<?php
## Define home base of the project, for saving time with paths and reducing error potential and for security
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/app/config/database_connection.php';
require BASE_PATH . '/app/config/helpers.php';
require BASE_PATH . '/app/config/lang_function.php';

## Required models  
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

## Required controllers
require_once BASE_PATH . '/app/Controllers/NpcController.php';

## Saving action in variable
$action = $_GET['action'] ?? null;

## If any action ongoing select right case
if ($action) {
  switch ($action) {
    case 'npc_save':
      NpcController::handleCreate($pdo);
      break;

    case 'npc_update':
      NpcController::update($pdo);
      break;

    case 'npc_delete':
      NpcController::delete($pdo);
      break;
    case 'session_save':
      // LogbookController::handleCreate($pdo);
      break;

    case 'session_update':
      // LogbookController::update($pdo);
      break;

    case 'session_delete':
      // LogbookController::delete($pdo);
      break;
  }
}

## Header
require_once BASE_PATH . '/app/Views/header.php';

## Save current page in variable
$page   = $_GET['page'] ?? 'home';
## Use page-variable to look what has to be loaded
switch ($page) {
  case 'home':
    $npcs = Npcs::getAll($pdo);
    require BASE_PATH . '/app/Views/home.php';
    break;

  case 'npc_form':
    $npcId = $_GET['id'] ?? null;
    $npc = null;

    $selectedTown = 1;
    $selectedParent = 1;
    $selectedClass = 1;
    $selectedProfession = 1;
    $selectedAlignment = 1;
    $selectedStatus = 1;
    $selectedSizeId = 1;
    $selectedInformation = "-- Enter information here --";

    if ($npcId) {
      $npc = Npcs::getById($pdo, (int)$npcId);

      if ($npc) {
        $selectedTown         = $npc['townId'];
        $selectedParent       = $npc['parentraceId'];
        $selectedClass        = $npc['classId'];
        $selectedProfession   = $npc['professionId'];
        $selectedAlignment    = $npc['alignmentId'];
        $selectedStatus       = $npc['statusId'];
        $selectedSizeId       = $npc['sizeId'];
        $selectedInformation  = $npc['information'];
      }
    }

    $parent_races = Parentraces::getAllParenraces($pdo);
    $towns        = Towns::getAll($pdo);
    $classes      = Classes::getAll($pdo);
    $professions  = Profession::getAll($pdo);
    $alignments   = Alignment::getAll($pdo);
    $status       = Status::getAllNpcStatus($pdo);
    $sizes        = Sizes::getAll($pdo);
    $information  = Npcs::getInfo($pdo);
    require BASE_PATH . '/app/Views/npc_form.php';
    break;

  case 'feedback':
    require BASE_PATH . '/app/Views/npcFormFeedback.php';
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
