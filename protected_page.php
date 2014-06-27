<?php
include_once 'includes/db_connect.php';
include_once 'includes/functions.php';
 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
            <p>Bonjour <?php echo htmlentities($_SESSION['username']); ?>!</p>
            <p>Retourner sur <a href="connexion.php">l'espace personnel</a></p>
        <?php else : ?>
            <p>
                <span class="error">Vous n'êtes pas autorisé à aller sur cette page.</span> Aller sur la page de<a href="connexion.php">connexion</a>.
            </p>
        <?php endif; ?>
    </body>
</html>