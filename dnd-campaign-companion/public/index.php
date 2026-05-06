<?php
require_once '../config/database_connection.php';

# Required models 
require_once '../src/Models/Npc.php';
require_once '../src/Models/Quest.php';
require_once '../src/Models/Race.php';
require_once '../src/Models/Town.php';
require_once '../src/Models/Class.php';

$page = $_GET['page'] ?? 'home';

require_once '../templates/header.php';

switch ($page) {
  case 'home':
    $npcs = getAllNpcs($pdo);
    require '../templates/home.php';
    break;

  case 'npc_form':
    $selectedTown = 1;
    $selectedParent = 1;
    $selectedClass = 1;

    $parent_races = getAllParenraces($pdo);
    $towns = getAllTowns($pdo);
    $classes = getAllClasses($pdo);
    require '../templates/npc_form.php';
    break;

  case 'quest_list':
    $quests = getAllQuest($pdo);
    require '../templates/quest_list.php';
    break;

  case 'race_detail':
    $races = getAllRaces($pdo);
    require '../templates/race_detail.php';
    break;

  case 'logbook':
    require '../templates/logbook.php';
    break;

  default:
    echo "<h1> 404 - Dungeon not found!</h1>";
}
