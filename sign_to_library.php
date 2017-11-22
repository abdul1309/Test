<?php
session_start();
include ("function_library.php");
if (isset($_POST['login'])) {
  login();
}
include ("header.php");
include ("footer.html");
?>
<br>
<div align="middle">
    <form method="post" action="<?php print $_SERVER['PHP_SELF']; ?>" accept-charset="UTF-8">
        <table>
            <?php
            print element("Vorname", "first_name", "text");
            print element("Nachname", "last_name", "text");
            print element("Geburtsdatum", "Date_of_birth", "date");
            print element("Adresse", "address", "text");
            print element("Ort", "place", "text");
            print element("PLZ", "postcode", "text");
            print element("Benutzername","user_name","text");
            print element("Passwort","password","password");
            print element("Passwort bestätigen","password_confirm","password");
            print element("Email","email","email");
            print radios ("Kunde oder Mitarbeiter","client_o_employee",['employee' => 'Mitarbeiter', 'client' => 'kunde'],":");
            print button("senden", "add_client_o_employee_into_database");
            if (isset($_POST['add_client_o_employee_into_database'])) {
              insert_into_database ("register");
            }
            ?>
        </table>
    </form>
</div>
<a href="index_library.php">Zurück</a>
