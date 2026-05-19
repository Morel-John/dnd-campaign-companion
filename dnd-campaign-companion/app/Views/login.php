<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DnD Campaign Companion - Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; background-color: #1a1a1a; color: #f5f5f5; font-family: sans-serif;">

    <div class="login-container" style="background-color: #2a2a2a; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.5); width: 100%; max-width: 400px;">
        <h2 style="text-align: center; color: #ffdd57; margin-bottom: 20px;">Dungeon Master Login</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <div style="background-color: #ff3860; color: white; padding: 10px; border-radius: 4px; margin-bottom: 15px; text-align: center;">
                <?= e($_GET['error'] === 'invalid' ? 'Kombination aus Name und Passwort falsch!' : 'Bitte alle Felder ausfüllen.') ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=login" method="POST">
            <div style="margin-bottom: 15px;">
                <label for="username" style="display: block; margin-bottom: 5px; color: #b5b5b5;">Benutzername</label>
                <input type="text" id="username" name="username" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #4a4a4a; background-color: #363636; color: white; box-sizing: border-box;">
            </div>

            <div style="margin-bottom: 20px;">
                <label for="password" style="display: block; margin-bottom: 5px; color: #b5b5b5;">Passwort</label>
                <input type="password" id="password" name="password" required style="width: 100%; padding: 10px; border-radius: 4px; border: 1px solid #4a4a4a; background-color: #363636; color: white; box-sizing: border-box;">
            </div>

            <button type="submit" style="width: 100%; padding: 12px; background-color: #ffdd57; border: none; border-radius: 4px; color: #1a1a1a; font-weight: bold; font-size: 1rem; cursor: pointer; transition: background 0.2s;">
                Eintreten
            </button>
        </form>
    </div>

</body>
</html>