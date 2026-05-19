<?php
## Define home base of the project, for saving time with paths and reducing error potential and for security
define('BASE_PATH', dirname(__DIR__));
require_once BASE_PATH . '/app/config/database_connection.php';
require_once BASE_PATH . '/app/config/session.php';
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
require_once BASE_PATH . '/app/Models/Logbook.php';

## Required controllers
require_once BASE_PATH . '/app/Controllers/NpcController.php';
require_once BASE_PATH . '/app/Controllers/LogbookController.php';

## Saving action in variable
$action = $_GET['action'] ?? null;

## If any action ongoing select right case
if ($action) {
  switch ($action) {
    case 'login':
      require_once BASE_PATH . '/app/Controllers/SessionController.php';
      break;

    case 'logout':
      session_destroy();
      header('Location: index.php?page=login');
      exit;

    case 'npc_save':
      NpcController::handleCreate($pdo);
      break;

    case 'npc_update':
      NpcController::update($pdo);
      break;

    case 'npc_delete':
      NpcController::delete($pdo);
      break;
    case 'logbook_save':
      LogbookController::handleCreate($pdo);
      break;

    case 'logbook_update':
      LogbookController::handleUpdate($pdo);
      break;

    case 'logbook_delete':
      LogbookController::handleDelete($pdo);
      break;
  }
}

## Save current page in variable
$page   = $_GET['page'] ?? 'home';

## Require login on every site expect login.php and also don´t load the header for the login
if ($page !== 'login') {
  requireLogin();
  ## Header
  require_once BASE_PATH . '/app/Views/header.php';
}

## Use page-variable to look what has to be loaded
switch ($page) {
  case 'login':
    if (isLoggedIn()) {
      header('Location: index.php?page=home');
      exit;
    }
    require BASE_PATH . '/app/Views/login.php';
    break;

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
    $logbooks = Logbook::getAll($pdo);
    require BASE_PATH . '/app/Views/logbook.php';
    break;

  case 'logbook_form':
    $logbookId = $_GET['id'] ?? null;
    $logbook = null;

    if ($logbookId) {
      $logbook = Logbook::getById($pdo, (int)$logbookId);
    }


    require BASE_PATH . '/app/Views/logbook_form.php';
    break;

  default:
    echo "<h1> 404 - Dungeon not found!</h1>";
}
