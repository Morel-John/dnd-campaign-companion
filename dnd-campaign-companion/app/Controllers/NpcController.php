<?php
class NpcController
{
    ## Überarbeiten ---------##########################################
    public static function handleUpload($prefix, $existingImage = 'assets/img/npc/default.png')
    // {
    //     if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    //         $destinationFolder = BASE_PATH . '/public/assets/img/npc/';
    //         $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    //         // Sicherer Dateiname: Zeitstempel + gesäuberter Name
    //         $cleanPrefix = str_replace(' ', '_', $prefix);
    //         $filename = time() . '_' .$cleanPrefix . '.' .  $extension;
    //         $targetPath = $destinationFolder . $filename;

    //         if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
    //             // Rückgabe des Web-Pfads für die DB
    //             return 'assets/img/npc/' . $filename;
    //         }else{
    //             error_log("Upload failed: Check permission for ". $destinationFolder);
    //         }
    //     }
    //     return $existingImage;
    // }
    {
        if (empty($_FILES['image']['name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            return $existingImage;
        }

        $destinationFolder = BASE_PATH . '/public/assets/img/npc/';
        $extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $cleanName  = preg_replace('/[^a-zA-Z0-9_-]/', '_', $prefix);
        $filename   = $cleanName . '_' . date('Y-m-d') . '.' . $extension;
        $targetPath = $destinationFolder . $filename;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            error_log("Upload failed: Check permission for " . $destinationFolder);
            return $existingImage;
        }

        return 'assets/img/npc/' . $filename;
    }
    ## ################################################################

    public static function handleSave($pdo)
    {
        // $imagePath = !empty($_POST['image']) ? $_POST['image'] : 'assets/img/npc/default.png';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $existingImage = $_POST['current_image'] ?? 'assets/img/npc/default.png';
            $imagePath = self::handleUpload($_POST['npcname'], $existingImage);
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

    public static function update($pdo)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            ## Überarbeiten ---------##########################################
            $npcId = (int)$_POST['npcId'];
            $oldImage = $_POST['current_image'] ?? 'assets/img/npc/default.png';

            $imagePath = self::handleUpload($npcId . '_' . $_POST['npcname'], $oldImage);
            ## ################################################################

            $npcData = [
                'id'          => (int)$_POST['npcId'],
                'name'        => $_POST['npcname'],
                'parentrace'  => (int)$_POST['parentraceId'],
                'town'        => (int)$_POST['townId'],
                'class'       => (int)$_POST['classId'],
                'profession'  => (int)$_POST['professionId'],
                'alignment'   => (int)$_POST['alignmentId'],
                'status'      => (int)$_POST['statusId'],
                'size'        => (int)$_POST['sizeId'],
                'info'        => $_POST['information'],
                'image'       => $imagePath,
            ];

            if (Npcs::update($pdo, $npcData)) {
                header('Location: index.php?page=feedback&status=successupdate');
                exit;
            } else {
                header('Location: index.php?page=error&status=errorupdate');
            }
        }
    }
}
