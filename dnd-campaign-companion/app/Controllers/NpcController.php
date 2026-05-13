<?php
class NpcController
{
    public static function handleUpload($prefix, $existingImage = 'assets/img/npc/default.png')
    {
        ## If no img or img but with error cancel function (return old img or default)
        if (empty($_FILES['image']['name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            return $existingImage;
        }
        ## Location to save image
        $destinationFolder = BASE_PATH . '/public/assets/img/npc/';
        ## Extracting file extension for creating new filename | $_FILES['image']['name'] just used to get extension | PATHINFO_EXTENSION extracts extension information
        $extension  = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        ## Cleaning userinput (no spaces no special characters)
        $cleanName  = preg_replace('/[^a-zA-Z0-9_-]/', '_', $prefix);
        ## Putting everything together for "new"-filename
        $filename   = $cleanName . '_' . date('Y-m-d') . '.' . $extension;
        ## Saving path of file in variable
        $targetPath = $destinationFolder . $filename;

        ## Moving file from temp area into $targetpath (move_upload_files does action and validation at the same time)
        if (!move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            error_log("Upload failed: Check permission for " . $destinationFolder);
            return $existingImage;
        }
        return 'assets/img/npc/' . $filename;
    }

    public static function handleCreate($pdo)
    {
        ## Ensure data is only processed on submission, not on initial page load
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            ## If we have an img-path we save it into a variable else we save our default settings 
            $existingImage = $_POST['current_image'] ?? 'assets/img/npc/default.png';
            ## Using function to rename our img if we upload a new one. (Giving information)
            $imagePath = self::handleUpload($_POST['npcname'], $existingImage);
            ## Creating associative array 
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
            ## If creating was successfull change url to get success message
            if (Npcs::create($pdo, $npcData)) {
                header('Location: index.php?page=feedback&status=success');
                exit;
            } else {
                ## If creating failed change url to get error message
                header('Location: index.php?page=error&status=error');
                exit;
            }
        }
    }

    public static function update($pdo)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            ## Saving NPC-Id in variable
            $npcId = (int)$_POST['npcId'];
            ## If we have an img-path we save it into a variable else we save our default settings 
            $existingImage = $_POST['current_image'] ?? 'assets/img/npc/default.png';
            ## Using function to rename our img (this time with ID) we upload
            $imagePath = self::handleUpload($npcId . '_' . $_POST['npcname'], $existingImage);

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
                exit;
            }
        }
    }

    public static function delete($pdo)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $npcId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
            if ($npcId > 0) {
                $npc = Npcs::getById($pdo, $npcId);
                if ($npc) {
                    if ($npc['image'] !== 'assets/img/npc/default.png') {
                        $fullpath = BASE_PATH . '/public/' . $npc['image'];

                        if (file_exists($fullpath)) {
                            unlink($fullpath);
                        }
                    }
                    if (Npcs::delete($pdo, $npcId)) {
                        header('Location: index.php?page=feedback&status=successdelete');
                        exit;
                    } else {
                        header('Location: index.php?page=feedback&status=errordelete');
                        exit;
                    }
                }
            }
        }
    }
}
