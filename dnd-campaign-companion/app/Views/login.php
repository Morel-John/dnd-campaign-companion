<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DnD Campaign Companion - Login</title>
    <link rel="stylesheet" href="assets/CSS/main.css">
</head>
<body class="login-background">

    <div class="login-container color-text">
        <h2>Dungeon Login</h2>
        
        <?php if (isset($_GET['error'])): ?>
            <div class="error_login">
                <?= e($_GET['error'] === 'invalid' ? 'Combination of username and password is incorrect!' : 'Please fill in all fields.') ?>
            </div>
        <?php endif; ?>

        <form action="index.php?action=login" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button  type="submit">
                Login
            </button>
        </form>
    </div>

</body>
</html>