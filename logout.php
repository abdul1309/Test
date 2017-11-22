<?php
if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
}
?>

<html>
    <head>
        <title></title>
    </head>
    <body>
        <form action="index_library.php" name="out" method="post">
            <button type="submit" name="logout" class="button_logout">logout</button>
        </form>
    </body>
</html>
