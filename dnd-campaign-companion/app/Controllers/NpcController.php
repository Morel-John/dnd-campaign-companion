<?php
class NpcController
{
    public static function handleSave($pdo)
    {
        $imagePath = !empty($_POST['image']) ? $_POST['image'] : 'assets/img/npc/default.png';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $npcData = [
                'name'        => $_POST['npcname'],
                'parentrace'  => (int)$_POST['parentraceId'],
                'town'        => (int)$_POST['townId'],
                'class'       => (int)$_POST['classId'],
                'profession'  => (int)$_POST['professionId'],
                'alignment'   => (int)$_POST['alignmentId'],
                'status'      => (int)$_POST['statusId'],
                'size'        => (int)$_POST['sizeId'],
                'info'        => $_POST['information'],
                'image'       => $imagePath
            ];

            if (Npcs::create($pdo, $npcData)) {
                header('Location: index.php?page=feedback&status=success');
                exit;
            } else {
                header('Location: index.php?page=error&status=error');
            }
        }
    }
}
