<?php
session_start();
include("function_library.php");
include ("footer.html");
include ("logout.php");
?>
<link rel="stylesheet" href="formular_library.css">

<form method="post" action="<?php print $_SERVER['PHP_SELF'];?>" accept-charset="UTF-8">
    <div align="middle">
        <p>
        <?php
        print $_SESSION['status'];
        print "</p>";
        print element("Bücher suchen","book_search","search");
        print button('suchen','search');
        print "</p>";
        print label("Bücher anzeigen","books_show",":");
        print button('anzeigen','show_books');
        echo '</p>';
        print label("Bücher Ausgeliehen","books_lend",":");
        print button('anzeigen','show_book_lend');
        if (isset($_POST['search']) || isset($_POST['show_books']) ||isset($_POST['show_book_lend'])  ) {
            echo "<br>";
          show_book_to_lend_or_book_to_library();
        }
        if (isset($_POST['lend']) || isset($_POST['return'])) {
          lend_or_return();
        }
        ?>
    </div>
</form>