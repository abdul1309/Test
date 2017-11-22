<!DOCTYPE html>
<html lang="en">
    <head>
        <title>bucherhalle</title>
        <link rel="stylesheet" href="formular_library.css">
    </head>
    <body>
        <header>
            <form method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" accept-charset="UTF-8">
                <a href="index_library.php">Home</a>
                <a href="sign_to_library.php" style="float:right">anmelden</a>
                <h1 style="text-align: center">Willkommen bei den Bücherhalle Hamburg</h1>
                <div align="middle">
                    <input type="text" name="user_name" placeholder="Benutzername">
                    <input type="password" name="password" placeholder="passwort">
                    <button type="submit" name="login">login</button>
                </div>
            </form>
        </header>
