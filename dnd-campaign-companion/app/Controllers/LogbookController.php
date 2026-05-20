<?php
class LogbookController
{
  public static function handleUpload($prefix, $existingImage = 'assets/img/logbook/default.png')
  {
    if (empty($_FILES['image']['name']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
      return $existingImage;
    }

    $folder    = BASE_PATH . '/public/assets/img/logbook/';
    $ext       = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
    $cleanName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $prefix);
    $filename  = $cleanName . '_' . date('Y-m-d') . '.' . $ext;

    if (!move_uploaded_file($_FILES['image']['tmp_name'], $folder . $filename)) {
      error_log("Upload failed: Check permission for " . $folder);
      return $existingImage;
    }

    return 'assets/img/logbook/' . $filename;
  }

  public static function handleCreate($pdo)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $existingImage = $_POST['current_image'] ?? 'assets/img/logbook/default.png';
      $imagePath = self::handleUpload($_POST['title'], $existingImage);

      $sessionData = [
        'title'     => $_POST['title'],
        'story'     => $_POST['story'],
        'date'      => $_POST['date'],
        'image'     => $imagePath
      ];
      if (Logbook::create($pdo, $sessionData)) {
        header('Location: index.php?page=feedback&status=successstory');
        exit;
      } else {
        ## If creating failed change url to get error message
        header('Location: index.php?page=error&status=errorstory');
        exit;
      }
    }
  }

  public static function handleUpdate($pdo)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $logbookId = (int)$_POST['logbookId'];
      $existingImage = $_POST['current_image'] ?? 'assets/img/logbook/default.png';
      $imagePath = self::handleUpload($logbookId . '_' . $_POST['title'], $existingImage);
      $sessionData = [
        'logbookId' => $logbookId,
        'title'     => $_POST['title'],
        'story'     => $_POST['story'],
        'date'      => $_POST['date'],
        'image'     => $imagePath
      ];
      if (Logbook::update($pdo, $sessionData)) {
        header('Location: index.php?page=feedback&status=successStoryUpdate');
        exit;
      } else {
        header('Location: index.php?page=error&status=errorStoryUpdate');
        exit;
      }
    }
  }

  public static function handleDelete($pdo)
  {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $logbookId = isset($_POST['id']) ? (int)$_POST['id'] : 0;
      if ($logbookId > 0) {
        $logbook = Logbook::getById($pdo, $logbookId);
        if ($logbook) {
          if ($logbook['image'] !== 'assets/img/logbook/default.png') {
            $fullpath = BASE_PATH . '/public/' . $logbook['image'];

            if (file_exists($fullpath)) {
              unlink($fullpath);
            }
          }
          if (Logbook::delete($pdo, $logbookId)) {
            header('Location: index.php?page=feedback&status=successStoryDelete');
            exit;
          } else {
            header('Location: index.php?page=feedback&status=errorStoryDelete');
            exit;
          }
        }
      }
    }
  }
}
