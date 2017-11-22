<?php
session_start();
include("function_library.php");
include ("footer.html");
include ("logout.php");
?>
<link rel="stylesheet" href="formular_library.css">
<form method="post" class="form_signin" action="<?php print $_SERVER['PHP_SELF']; ?>" accept-charset="UTF-8">
   <?php print '<h1>'. $_SESSION["status"].'</h1>';?>
    <div align="middle">
        <table>
            <?php
            print "<br>";
            print label('Person','person',':');
            print button('anzeigen','show_person');
            print button('suchen','search_person');
            print button('hinzufügen','add_person');
            echo '<tr>';
            print label('Buch','book',':');
            print button('anzeigen','show_book');
            print button('suchen','search_book');
            print button('hinzufügen','add_book');
            echo '<tr>';
            print label('Bucherhalle','library',':');
            print button('anzeigen','show_library');
            print button('suchen','search_library');
            print button('hinzufügen','add_library');
            echo '<tr>';
            print label('Kategorie','kategorie',':');
            print button('anzeigen','show_category');
            print button('suchen','search_kategorie');
            print button('hinzufügen','add_kategorie');
            ?>
        </table>
        <table>
            <?php
            if (isset($_POST['add_person'])) {
                print element("Vorname", "first_name", "text");
                print element("Nachname", "last_name", "text");
                print element("Geburtsdatum", "Date_of_birth", "date");
                print element("Adresse", "address", "text");
                print element("Ort", "place", "text");
                print element("PLZ", "postcode", "text");
                print element("Benutzername", "user_name", "text");
                print element("Passwort", "password", "password");
                print element("Passwort bestätigen", "password_confirm", "password");
                print element("Email", "email", "email");
                print radios("Kunde oder Mitarbeiter", "client_o_employee", ['employee' => 'Mitarbeiter', 'client' => 'kunde'], ":");
                print button("senden", "add_person_to_database");
            }
            if (isset($_POST['add_person_to_database'])) {
              insert_into_database("register");
            }elseif (isset($_POST['show_person'])) {
              show();
            }elseif (isset($_POST['search_person'])) {
              print element("Nachname", "last_name", "text");
              print element("Id Person", "id_person", "text");
              print button('senden', 'sendNameOId');
            }
            if (isset($_POST['sendNameOId']) && !empty($_POST['last_name'])) {
              search("search_name_person");
            }elseif (isset($_POST['sendNameOId']) && !empty($_POST['id_person'])) {
              search("search_id_person");

            }
            if (isset($_POST['conformation_person'])) {
                conformation();
            }elseif (isset($_POST['conformation_person_intoDatebase'])){
              correct_the_information ('person');

            }
            if (isset($_POST['delete_person'])) {
              delete("person");

            }

            if (isset($_POST['add_library'])) {
                print element("Bucherhallesname", "name_library", "text");
                print element("Adresse", "address", "text");
                print element("Ort", "area", "text");
                print element("PLZ","Postcode","text");
                print button("senden", "add_Bibliothek_into_database");
            }else {
                if (isset($_POST['add_Bibliothek_into_database'])) {
                  insert_into_database("add_library");
                }elseif (isset($_POST['show_library'])) {
                  show();
                }elseif (isset($_POST['conformation_library'])) {
                  conformation();
                }elseif (isset($_POST['conformation_library_intoDatebase'])) {
                  correct_the_information ('library');

                }elseif (isset($_POST['search_library'])) {
                  print element("Bucherhale Name", "name_library", "text");
                  print element("Id Bucherhalle", "id_library", "text");
                    print button('senden', 'sendNameOId');
                }
                if (isset($_POST['sendNameOId']) && !empty($_POST['name_library'])) {
                    search("search_name_library");
                }elseif (isset($_POST['sendNameOId']) && !empty($_POST['id_library'])) {
                    search("search_id_library");
                }
            }
            if (isset($_POST['delete_library'])) {
              delete("library");

            }
            if (isset($_POST['add_book'])) {
                print element("Name", "name_book", "text");
                print element("Titel", "title", "text");
                print element("Autor", "author", "text");
                print element("categorie name","categorie_name","select");
                print button("senden", "add_book_into_database");
            }else {
                if (isset($_POST['add_book_into_database'])) {
                  insert_into_database("add_book");
                }elseif (isset($_POST['show_book'])) {
                  show();
                }elseif (isset($_POST['conformation_book'])) {
                  conformation();
                }elseif (isset($_POST['conformation_book_intoDatebase'])){
                  correct_the_information ('book');

                }
                elseif (isset($_POST['search_book'])) {
                  print element("Bücher suchen", "book_search", "text");
                  print element("Id Buch", "id_book", "text");
                    print button('senden', 'sendNameOId');
                }
                if (isset($_POST['sendNameOId']) && !empty($_POST['book_search'])) {
                    search("search_name_book");
                }elseif (isset($_POST['sendNameOId']) && !empty($_POST['id_book'])) {
                        search("search_id_book");
                }
            }
            if (isset($_POST['delete_book'])) {
              delete("book");

            }

            if (isset($_POST['add_kategorie'])) {
              print element("Name", "name_kategorie", "text");
              print button("senden", "add_kategorie_into_database");
            }else {
                if (isset($_POST['add_kategorie_into_database'])) {
                    insert_into_database("add_kategorie");
                }elseif (isset($_POST['show_category'])) {
                  show();
                }elseif (isset($_POST['conformation_category'])) {
                  conformation();
                }elseif (isset($_POST['conformation_category_intoDatebase'])) {
                  correct_the_information ('category');
                }elseif (isset($_POST['search_kategorie'])) {
                  print element("kategorie Name", "name_category", "text");
                  print element("Id kategorie", "id_category", "text");
                    print button('senden', 'sendNameOId');
                }elseif (isset($_POST['sendNameOId'])){
                  if (!empty($_POST['name_category'])) {
                    search("search_name_category");
                  }elseif (!empty($_POST['id_category'])) {
                    search("search_id_category");

                  }
                }
            }
            if (isset($_POST['delete_category'])) {
                delete("category");
            }
            ?>
        </table>
    </div>
</form>



