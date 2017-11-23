<?php
session_start();
include ("function_library.php");
if (isset($_POST['login'])) {
  login();
}
include ("header.php");

?>
<br>
<form method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" accept-charset="UTF-8">
    <div align="middle">
        <?php
            print element("Bücher suchen","book_search","search");
            print button('suchen','search');
            print "<br>";
            print label("Bücher anzeigen","books_show",":");
            print button('anzeigen','show_books');
        if (isset($_POST['search']) && !empty($_POST['book_search']) || isset($_POST['show_books'])) {
          show_book_to_lend_or_book_to_library();
            }
        if (isset($_POST['lend'])) {
            echo '<br>';
            print "Bitte melden Sie sich dann können Sie ein oder merhre Bücher Ausleihen";
        }
        $x = "test";
            echo '<br>';
        ?>
    </div>
</form>
<br>
<div align="middle">
    <img src="https://www.buecherhallen.de/global/show_picture.asp?id=aaaaaaaaaadszfs" >
</div>
<?php
include ("footer.html");
?>