<?php
  function label ($title,$name,$mandatory) {
    return '<td><label name = '.$name.'>'.$title.$mandatory.'</label></td>';
  }

  function element($title, $name, $mandatory)
  {
    $get_element = null;
    if (!empty($_POST[$name])) {
      $value = $_POST[$name];
    } else {
      $value = '';
    }
    switch ($mandatory) {
      case 'text':
        $get_element = '<tr><td><input type="text" name="' . $name . '" value="' . $value . '" placeholder="' . $title . '"  ></td></tr>';
        break;
      case 'search':
        $get_element = '<tr><td><input type="search" name="' . $name . '" value="' . $value . '"  placeholder="' . $title . '"></td></tr>';
        break;
      case 'password':
        $get_element = '<tr><td><input type="password" name="' . $name . '" value="' . $value . '" placeholder="' . $title . '" ></td></tr>';
        break;
      case 'email':
        $get_element = '<tr><td><input type="email" name="' . $name . '" value="' . $value . '" placeholder="' . $title . '" ></td></tr>';
        break;
      case 'date':
        $get_element = '<tr><td><input type="date" name="' . $name . '" value="' . $value . '" placeholder="' . $title . '" ></td></tr>';
        break;
      case 'select':
        global $options;
        $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
        if ($connect) {
          $category = "SELECT id_kategorie, name FROM kategorie";
          $db_erg_category = mysqli_query($connect, $category);
          if (!$db_erg_category) {
            print "Error: " . $db_erg_category . "<br>" . mysqli_error($connect);
          } else {
            $option = ['<option value="">Kategorie</option>'];
            while ($zeile = mysqli_fetch_array($db_erg_category, MYSQLI_ASSOC)) {
              $zeile['name'];
              $zeile ['id_kategorie'];
              if (isset($_POST['categorie_name']) && !empty($_POST['categorie_name']) && $zeile['name'] == $_POST['categorie_name']) {
                $select = ' selected="selected"';
              } else {
                $select = '';
              }
              $option[] = '<option value="' . $zeile ['id_kategorie'] . '" ' . $select . '>' . $zeile['name'] . '</option>';
              $options = implode(PHP_EOL, $option);
            }
            return $get_element . '<td><select name="' . $name . '">' . $options . '</select></td>';
          }
        }
    }
    return $get_element;
  }


  function radios($title, $name, array $values, $mandatory)
  {
    $get_radios = array();
    foreach ($values as $key => $value) {
      if ((isset($_POST[$name]) && !empty($_POST[$name])) && $key == $_POST[$name]) {
        $selected = ' checked="checked"';
      } else {
        $selected = '';
      }

      $get_radios [] = '<tr><td><input type="radio" name="' . $name . '" value="' . $key . '" ' . $selected . '>' . $value ;
    }
    $get_alles = implode(PHP_EOL, $get_radios);

    return  $get_alles.'</td></tr>';

  }


  function button($title, $name)
  {
    $button = '<td><button type="submit"  name="' . $name . '">' . $title . '</button></td>';
    return $button;
  }

  function button_value ($title, $name, $value) {

    $button = '<button type="submit"  name="' . $name . '" value = "'.$value.'">' . $title . '</button>';
    return $button;
  }


function element_value_chang( $name , $value, $mandatory)
{

  $get_element = null;
  switch ($mandatory) {
    case 'text':
      $get_element = '<input type="text" name="' . $name . '" value="' . $value . '" >';
      break;
    case 'search':
      $get_element = '<input type="search" name="' . $name . '" value="' . $value . '" >';
      break;
    case 'password':
      $get_element = '<input type="password" name="' . $name . '" value="' . $value . '" >';
      break;
    case 'email':
      $get_element = '<input type="email" name="' . $name . '" value="' . $value . '"  >';
      break;
    case 'date':
      $get_element = '<input type="date" name="' . $name . '" value="' . $value . '"  >';
      break;
    case 'select':
      global $options;
      $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
      if ($connect) {
        $category_name = "SELECT id_kategorie, name FROM kategorie WHERE id_kategorie = $value ";
        $db_erg_category_name = mysqli_query($connect, $category_name);
        $category_value = "SELECT id_kategorie, name FROM kategorie";
        $db_erg_category_value = mysqli_query($connect, $category_value);
        if (!$db_erg_category_name) {
          print "Error: " . $db_erg_category_name . "<br>" . mysqli_error($connect);
        } else {
          while ($zeile_name = mysqli_fetch_array($db_erg_category_name, MYSQLI_ASSOC)) {
            $option = ['<option value="'.$zeile_name ['id_kategorie'].'">' . $zeile_name ['name'] . '</option>'];
            $zeile_name ['name'];
            while ($zeile = mysqli_fetch_array($db_erg_category_value, MYSQLI_ASSOC)) {
              $zeile['name'];
              $zeile ['id_kategorie'];
              if (isset($_POST['categorie_name']) && !empty($_POST['categorie_name']) && $zeile['name'] == $_POST['categorie_name']) {
                $select = ' selected="selected"';
              } else {
                $select = '';
              }
              if ($zeile_name ['name'] != $zeile['name']) {
                $option[] = '<option value="' . $zeile ['id_kategorie'] . '" ' . $select . '>' . $zeile['name'] . '</option>';
                $options = implode(PHP_EOL, $option);
              } else {
                print "hallo";
              }
            }
            return $get_element . '<td><select name="' . $name . '">' . $options . '</select></td>';
          }
        }
      }
  }
  return $get_element;
}

  function login()
  {
    $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
    if ($connect) {
      if (!empty($_POST['user_name'])) {
        if (!empty($_POST['password'])) {
          $username = $_POST['user_name'];
          $password = md5($_POST['password']);
          $sql_id = " SELECT id_kunde FROM kunde WHERE benutzername = '$username' AND passwort ='$password'";
          $db_erg_id = mysqli_query($connect, $sql_id);
          if (!$db_erg_id) {
          }else {
            while ($zeile = mysqli_fetch_array($db_erg_id, MYSQLI_ASSOC)) {
              $kunde_id = $zeile['id_kunde'];
              $_SESSION ["id"] = $kunde_id;
              $sql_name = "SELECT nachname FROM kunde WHERE id_kunde = '$kunde_id'";
              $db_erg_name = mysqli_query($connect, $sql_name);
              while ($zeile = mysqli_fetch_array($db_erg_name, MYSQLI_ASSOC)) {
                $kunde_name = $zeile['nachname'];
                $sql_status = "SELECT mitarbeiter FROM kunde WHERE nachname ='$kunde_name'";
                $db_erg_status = mysqli_query($connect, $sql_status);
                while ($zeile = mysqli_fetch_array($db_erg_status, MYSQLI_ASSOC)) {
                  $array_zeile = $zeile['mitarbeiter'];
                  if ($array_zeile =='ja') {
                    $_SESSION["status"] = "Willkommen unser Mitarbeiter ".$kunde_name;
                    header("location:employee.php");
                    break;
                  }else {
                    $_SESSION["status"] = "Willkommen unser kunde ".$kunde_name;
                    header("location:client.php");
                    break;
                  }
                }
              }

            }
            if ($zeile == null) {
              print "Benutzername oder Passwort sind falsch";
            }
          }
        } else {
          echo "passwort ist leer";
        }
      } else {
        echo "Benutzername ist leer";
      }
    } else {
      print "keine Verbindung möglich";
    }
  }


function show () {
  $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
  if ($connect) {
    if (isset($_POST['show_person'])) {
      $sql = "SELECT * FROM kunde";
      $db_sql = mysqli_query($connect, $sql);
      if (!$db_sql) {
        print "Error: " . $sql . "<br>" . mysqli_error($connect);
      } else {
        print '<table border="1">';
        echo "<tr><td>Id kunde</td><td>Vorname</td><td>Nachname</td><td>Geburtsdatum</td><td>Adresse</td><td>Ort</td><td>Plz</td><td>Benutzername</td>
          <td>Passwort</td><td>Email</td><td>Mitarbeiter</td><td>Kunde</td>";
        while ($zeile = mysqli_fetch_array($db_sql, MYSQLI_ASSOC)) {
          echo '<br>';
          echo "<tr>";
          echo "<td>" . $zeile['id_kunde'] . "</td>";
          echo "<td>" . $zeile['vorname'] . "</td>";
          echo "<td>" . $zeile['nachname'] . "</td>";
          echo "<td>" . $zeile['geburtsdatum'] . "</td>";
          echo "<td>" . $zeile['adresse'] . "</td>";
          echo "<td>" . $zeile['ort'] . "</td>";
          echo "<td>" . $zeile['plz'] . "</td>";
          echo "<td>" . $zeile['benutzername'] . "</td>";
          echo "<td>" . $zeile['passwort'] . "</td>";
          echo "<td>" . $zeile['email'] . "</td>";
          echo "<td>" . $zeile['mitarbeiter'] . "</td>";
          echo "<td>" . $zeile['kunde'] . "</td>";
          echo "<td>" . button_value('bearbeiten', 'conformation_person', $zeile['id_kunde']) . "</td>";
          echo "<td>" . button_value('löschen', 'delete_person', $zeile['id_kunde']) . "</td>";
          echo "</tr>";
        }

        echo "</table>";

      }
    } elseif (isset($_POST['show_book'])) {
      $sql_book = "SELECT * FROM buch";
      $db_erg_sql_book = mysqli_query($connect, $sql_book);
      if (!$db_erg_sql_book) {
        echo "Error: " . $db_erg_sql_book . "<br>" . mysqli_error($connect);
      } else {
        print '<br>';
        print '<table border="1">';
        echo "<tr><td>Id Buch</td><td>Name</td><td>Title</td><td>Kategorie</td>";
        while ($zeileBook = mysqli_fetch_array($db_erg_sql_book, MYSQLI_ASSOC)) {
          $idCat = $zeileBook['id_kategorie'];
          $sql_name_category = "SELECT name FROM kategorie WHERE id_kategorie = '$idCat'";
          $db_erg_sql_name_category = mysqli_query($connect, $sql_name_category);
          while ($zeile_name_categrie = mysqli_fetch_array($db_erg_sql_name_category, MYSQLI_ASSOC)) {
            echo "<tr>";
            echo "<td>" . $zeileBook['id_buch'] . "</td>";
            echo "<td>" . $zeileBook['name'] . "</td>";
            echo "<td>" . $zeileBook['title'] . "</td>";
            echo "<td>" . $zeile_name_categrie['name'] . "</td>";
            echo "<td>" . button_value('bearbeiten', 'conformation_book', $zeileBook['id_buch']) . "</td>";
            echo "<td>" . button_value('löschen', 'delete_book', $zeileBook['id_buch']) . "</td>";
            echo "</tr>";
          }
        }
        echo "</table>";
      }
    } elseif (isset($_POST['show_library'])) {
      $sql = "SELECT * FROM bibliothek ";
      $db_erg = mysqli_query($connect, $sql);
      if (!$db_erg) {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
      } else {
        print '<table border="1">';
        echo "<tr> <td>Id Bibliothek</td><td>Name</td><td>Adresse</td><td>Ort</td><td>Plz</td>";
        while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
          echo '<br>';
          echo "<tr>";
          echo "<td>" . $zeile['id_bibliothek'] . "</td>";
          echo "<td>" . $zeile['name'] . "</td>";
          echo "<td>" . $zeile['adresse'] . "</td>";
          echo "<td>" . $zeile['ort'] . "</td>";
          echo "<td>" . $zeile['plz'] . "</td>";
          echo "<td>" . button_value('bearbeiten', 'conformation_library', $zeile['id_bibliothek']) . "</td>";
          echo "<td>" . button_value('löschen', 'delete_library', $zeile['id_bibliothek']) . "</td>";
          echo "</tr>";
        }
      }
      echo "</table>";
    }elseif (isset($_POST['show_category'])) {
      $sql = "SELECT * FROM kategorie";
      $db_erg = mysqli_query($connect, $sql);
      if (!$db_erg) {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
      } else {
        print '<table border="1">';
        echo "<tr><td>Id Kategorie</td><td>Name</td>";
        while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
          echo '<br>';
          echo "<tr>";
          echo "<td>" . $zeile['id_kategorie'] . "</td>";
          echo "<td>" . $zeile['name'] . "</td>";
          echo "<td>" . button_value('bearbeiten', 'conformation_category', $zeile['id_kategorie']) . "</td>";
          echo "<td>" . button_value('löschen', 'delete_category', $zeile['id_kategorie']) . "</td>";
          echo "</tr>";
        }
        echo "</table>";
      }
    }
  }
}


function conformation()
{
  $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
  if (isset($_POST['conformation_person'])) {
    $id_person = $_POST['conformation_person'];
    $sql = "SELECT * FROM kunde WHERE id_kunde = $id_person";
    $db_sql = mysqli_query($connect, $sql);
    if (!$db_sql) {
      print "Error: " . $sql . "<br>" . mysqli_error($connect);
    } else {
      print '<table border="1">';
      while ($zeile = mysqli_fetch_array($db_sql, MYSQLI_ASSOC)) {
        echo '<br>';
        echo "<tr><td>Vorname:</td><td>" . element_value_chang('first_name_chang', $zeile['vorname'], 'text') . "</td></tr>";
        echo "<tr><td>Nachname:</td><td>" . element_value_chang('last_name_chang', $zeile['nachname'], 'text') . "</td></tr>";
        echo "<tr><td>Geburtsdatum:</td><td>" . element_value_chang('date_chang', $zeile['geburtsdatum'], 'date') . "</td></tr>";
        echo "<tr><td>Adresse:</td><td>" . element_value_chang('address_chang', $zeile['adresse'], 'text') . "</td></tr>";
        echo "<tr><td>Ort:</td><td>" . element_value_chang('area_chang', $zeile['ort'], 'text') . "</td></tr>";
        echo "<tr><td>Plz:</td><td>" . element_value_chang('plz_chang', $zeile['plz'], 'text') . "</td></tr>";
        echo "<tr><td>Benutzername:</td><td>" . element_value_chang('user_name_chang', $zeile['benutzername'], 'text') . "</td></tr>";
        echo "<tr><td>Passwort:</td><td>" . element_value_chang('password_chang', null, 'password') . "</td></tr>";
        echo "<tr><td>Passwort bestätigen:</td><td>" . element_value_chang('password_confirm', null, 'password') . "</td></tr>";
        echo "<tr><td>Email:</td><td>" . element_value_chang('email_chang', $zeile['email'], 'email') . "</td></tr>";
        echo "<tr><td>Mitarbeiter:</td><td>" . element_value_chang('employee_chang', $zeile['mitarbeiter'], 'text') . "</td></tr>";
        echo "<tr><td>Kunde:</td><td>" . element_value_chang('client_chang', $zeile['kunde'], 'text') . "</td></tr>";
        echo "<td></td>";
        echo "<td>" . button_value('senden', 'conformation_person_intoDatebase', $zeile['id_kunde']);
        echo button_value('abrechen', 'cancel_the_process_update_persone', 'abrechen') . "<td>";
      }
      echo "</table>";
    }
  }elseif (isset($_POST['conformation_book'])) {
    $id_book = $_POST['conformation_book'];
    $sql = "SELECT * FROM buch WHERE id_buch = $id_book";
    $db_sql = mysqli_query($connect, $sql);
    if (!$db_sql) {
      print "Error: " . $sql . "<br>" . mysqli_error($connect);
    } else {
      print '<table border="1">';
      echo "<tr><td>Name</td><td>Title</td><td>Kategorie</td>";
      while ($zeile = mysqli_fetch_array($db_sql, MYSQLI_ASSOC)) {
        echo '<br>';
        echo "<tr>";
        echo "<td>" . element_value_chang('book_name_chang', $zeile['name'], 'text') . "</td>";
        echo "<td>" . element_value_chang('titel_chang', $zeile['title'], 'text') . "</td>";
        echo element_value_chang('Kategorie', $zeile['id_kategorie'], 'select');
        echo "<td>" . button_value('senden', 'conformation_book_intoDatebase', $zeile['id_buch']) . "</td>";
        echo "<td>" . button_value('abrechen', 'cancel_the_process_update_book', 'abrechen') . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
  }elseif (isset($_POST['conformation_library'])) {
    $id_library = $_POST['conformation_library'];
    $sql = "SELECT * FROM bibliothek WHERE id_bibliothek = $id_library";
    $db_sql = mysqli_query($connect, $sql);
    if (!$db_sql) {
      print "Error: " . $sql . "<br>" . mysqli_error($connect);
    } else {
      print '<table border="1">';
      echo "<tr><td>Name</td><td>Adresse</td><td>ort</td><td>plz</td>";
      while ($zeile = mysqli_fetch_array($db_sql, MYSQLI_ASSOC)) {
        echo '<br>';
        echo "<tr>";
        echo "<td>" . element_value_chang('name_library_chang', $zeile['name'], 'text') . "</td>";
        echo "<td>" . element_value_chang('address_library_chang', $zeile['adresse'], 'text') . "</td>";
        echo "<td>" . element_value_chang('ort_library_chang', $zeile['ort'], 'text') . "</td>";
        echo "<td>" . element_value_chang('plz_library_chang', $zeile['plz'], 'text') . "</td>";
        echo "<td>" . button_value('senden', 'conformation_library_intoDatebase', $zeile['id_bibliothek']) . "</td>";
        echo "<td>" . button_value('abrechen', 'cancel_the_process_update_library', 'abrechen') . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
  }elseif (isset($_POST['conformation_category'])) {
    $id_category = $_POST['conformation_category'];
    $sql = "SELECT * FROM kategorie WHERE id_kategorie = $id_category";
    $db_sql = mysqli_query($connect, $sql);
    if (!$db_sql) {
      print "Error: " . $sql . "<br>" . mysqli_error($connect);
    }else {
      print '<table border="1">';
      echo "<tr><td>Name</td>";
      while ($zeile = mysqli_fetch_array($db_sql, MYSQLI_ASSOC)) {
        echo '<br>';
        echo "<tr>";
        echo "<td>" . element_value_chang('name_category_chang', $zeile['name'], 'text') . "</td>";
        echo "<td>" . button_value('senden', 'conformation_category_intoDatebase', $zeile['id_kategorie']) . "</td>";
        echo "<td>" . button_value('abrechen', 'cancel_the_process_update_category', 'abrechen') . "</td>";
        echo "</tr>";
      }
      echo "</table>";
    }
  }
}

function correct_the_information($kind)
{
  $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
  switch ($kind) {
    case 'person':
      $id_person = $_POST['conformation_person_intoDatebase'];
      $sql_ubdate = null;
      if (!empty($_POST['password_chang']) || !empty($_POST['password_confirm'])) {
          if ($_POST['password_chang'] == $_POST['password_confirm'] && strlen($_POST['password_chang']) >= 8) {
            $sql_ubdate = " UPDATE kunde SET
         vorname = \"" . $_POST['first_name_chang'] . "\",
         nachname =\" " . $_POST['last_name_chang'] . "\",
         geburtsdatum =\"" . $_POST['date_chang'] . "\",
         adresse = \"" . $_POST['address_chang'] . "\",
         ort =\" " . $_POST['area_chang'] . "\",
         plz =\" " . $_POST['plz_chang'] . "\",
         benutzername = \"" . $_POST['user_name_chang'] . "\",
         passwort = \"" .md5( $_POST['password_chang']) . "\",
         email = \"" . $_POST['email_chang'] . "\",
         mitarbeiter = \"" . $_POST['employee_chang'] . "\",
         kunde = \"" . $_POST['client_chang'] . "\"
           WHERE id_kunde = '$id_person'";
           $db_sql_ubdate = mysqli_query($connect, $sql_ubdate);
              if ($db_sql_ubdate) {
                print "Die Information werden ändern";
              }
          }else {
            print "Die Passwort und die Passwort bestätigen sind nicht gleich oder das Passwort ist kleiner als 8 ";
          }
      }elseif(empty($_POST['password_chang']) && empty($_POST['password_confirm'])) {
        $sql_ubdate = " UPDATE kunde SET
         vorname = \"" . $_POST['first_name_chang'] . "\",
         nachname =\" " . $_POST['last_name_chang'] . "\",
         geburtsdatum =\"" . $_POST['date_chang'] . "\",
         adresse = \"" . $_POST['address_chang'] . "\",
         ort =\" " . $_POST['area_chang'] . "\",
         plz =\" " . $_POST['plz_chang'] . "\",
         benutzername = \"" . $_POST['user_name_chang'] . "\",
         email = \"" . $_POST['email_chang'] . "\",
         mitarbeiter = \"" . $_POST['employee_chang'] . "\",
         kunde = \"" . $_POST['client_chang'] . "\"
           WHERE id_kunde = '$id_person'";
        $db_sql_ubdate = mysqli_query($connect, $sql_ubdate);
        if ($db_sql_ubdate) {
          print "Die Information werden ändern";
        }
      }
      break;
    case 'book':
      $id_book = $_POST['conformation_book_intoDatebase'];
      $sql_ubdate = " UPDATE buch SET
         name = \"" . $_POST['book_name_chang'] . "\",
         title =\" " . $_POST['titel_chang'] . "\",
         id_kategorie =\"" .  $_POST['Kategorie'] . "\"
           WHERE id_buch = '$id_book'";
      $db_sql_ubdate = mysqli_query($connect, $sql_ubdate);
      if (!$db_sql_ubdate) {
        echo "Erro" . $sql_ubdate . '<br>' . mysqli_error($connect);
      }else {
        print "Die Information werden ändern";
      }
      break;
    case 'library':
      $id_library = $_POST['conformation_library_intoDatebase'];
      $sql_ubdate = " UPDATE bibliothek SET
         name = \"" . $_POST['name_library_chang'] . "\",
         adresse =\" " . $_POST['address_library_chang'] . "\",
         ort =\"" . $_POST['ort_library_chang'] . "\",
         plz = \"" . $_POST['plz_library_chang'] . "\"
           WHERE id_bibliothek = '$id_library'";
      $db_sql_ubdate = mysqli_query($connect, $sql_ubdate);
      if (!$db_sql_ubdate) {
        echo "Erro" . $sql_ubdate . '<br>' . mysqli_error($connect);
      }else {
        print "Die Information werden ändern";
      }
      break;
    case 'category':
      $id_category = $_POST['conformation_category_intoDatebase'];
      $sql_ubdate = " UPDATE kategorie SET
         name = \"" . $_POST['name_category'] . "\"
           WHERE id_kategorie = '$id_category'";
      $db_sql_ubdate = mysqli_query($connect, $sql_ubdate);
      if (!$db_sql_ubdate) {
        echo "Erro" . $sql_ubdate . '<br>' . mysqli_error($connect);
      }else {
        print "Die Information werden ändern";
      }
    break;
  }
}

function delete($kind)
{
  global $db_erg, $sql;
  $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
  if ($kind == "person") {
    $id_person = $_POST['delete_person'];
    $sql = "DELETE FROM kunde WHERE id_kunde ='$id_person' ";
    $db_erg = mysqli_query($connect, $sql);
  } elseif ($kind == "book") {
    $id_book = $_POST['delete_book'];
    $sql = "DELETE FROM buch WHERE id_buch ='$id_book' ";
    $db_erg = mysqli_query($connect, $sql);
  } elseif ($kind == "library") {
    $id_library = $_POST['delete_library'];
    $sql = "DELETE FROM bibliothek WHERE id_bibliothek ='$id_library' ";
    $db_erg = mysqli_query($connect, $sql);
  } elseif ($kind == "category") {
    $id_category = $_POST['delete_category'];
    $sql = "DELETE FROM kategorie WHERE id_kategorie ='$id_category' ";
    $db_erg = mysqli_query($connect, $sql);
  }
  if (!$db_erg) {
    echo "Error: " . $sql . "<br>" . mysqli_error($connect);
  } else {
    print "Erfolgreich behandelet";
  }
}

function search($kind)
{
  global $sql;
  $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
  if ($connect) {
    if ($kind == "search_id_person" || $kind == "search_name_person") {
      if (!empty($_POST ['id_person'])) {
        $id = $_POST['id_person'];
        $sql = "SELECT * FROM kunde WHERE id_kunde ='$id' ";
      } elseif (!empty($_POST ['last_name'])) {
        $name_person = $_POST['last_name'];
        $sql = "SELECT * FROM kunde WHERE nachname ='$name_person' ";
      }
      $db_erg = mysqli_query($connect, $sql);

      if (!$db_erg) {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
      }else {
        print '<table border="1">';
        echo "<tr><td>idkunde</td><td>vorname</td><td>nachname</td><td>geburtsdatum</td><td>adresse</td><td>ort</td><td>plz</td><td>benutzername</td>
            <td>passwort</td><td>email</td><td>mitarbeiter</td><td>kunde</td>";
        while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
          echo '<br>';
          echo "<tr>";
          echo "<td>" . $zeile['id_kunde'] . "</td>";
          echo "<td>" . $zeile['vorname'] . "</td>";
          echo "<td>" . $zeile['nachname'] . "</td>";
          echo "<td>" . $zeile['geburtsdatum'] . "</td>";
          echo "<td>" . $zeile['adresse'] . "</td>";
          echo "<td>" . $zeile['ort'] . "</td>";
          echo "<td>" . $zeile['plz'] . "</td>";
          echo "<td>" . $zeile['benutzername'] . "</td>";
          echo "<td>" . $zeile['passwort'] . "</td>";
          echo "<td>" . $zeile['email'] . "</td>";
          echo "<td>" . $zeile['mitarbeiter'] . "</td>";
          echo "<td>" . $zeile['kunde'] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
      }
    }
    if ($kind == 'search_name_book') {
      if (!empty($_POST['book_search'])) {
        $book_name = $_POST ['book_search'];
        $sql_book_name = "SELECT * FROM buch WHERE name = '$book_name'";
        $sql_id_category = "SELECT id_kategorie FROM buch WHERE name = '$book_name'";
        $db_erg_sql_bookname = mysqli_query($connect, $sql_book_name);
        $db_erg_sql_id_category = mysqli_query($connect, $sql_id_category);
        if (!$db_erg_sql_bookname && !$db_erg_sql_id_category) {
          echo "Error: " . $sql_book_name . "<br>" . mysqli_error($connect);
          echo "Error: " . $sql_id_category . "<br>" . mysqli_error($connect);
        }else {
          print '<table border="1">';
          echo "<tr><td>Id Buch</td><td>Name</td><td>Title</td><td>category</td>";
          while ($zeileBook = mysqli_fetch_array($db_erg_sql_bookname, MYSQLI_ASSOC)) {
            $idCat = $zeileBook['id_kategorie'];
            $sql_name_category = "SELECT name FROM kategorie WHERE id_kategorie = '$idCat'";
            $db_erg_sql_name_category = mysqli_query($connect, $sql_name_category);
            while ($zeile_name_categrie = mysqli_fetch_array($db_erg_sql_name_category, MYSQLI_ASSOC)) {
              echo "<tr>";
              echo "<td>" . $zeileBook['id_buch'] . "</td>";
              echo "<td>" . $zeileBook['name'] . "</td>";
              echo "<td>" . $zeileBook['title'] . "</td>";
              echo "<td>" . $zeile_name_categrie['name'] . "</td>";
              echo "</tr>";
            }
          }
          echo "</table>";
        }
      }
    }elseif ($kind == "search_id_book") {
      $id_book = $_POST['id_book'];
      $sql_id_book = "SELECT * FROM buch WHERE id_buch ='$id_book'";
      $db_erg_sql_id_book = mysqli_query($connect, $sql_id_book);
      if (!$db_erg_sql_id_book) {
        echo "Error: " . $db_erg_sql_id_book . "<br>" . mysqli_error($connect);
      }
      print '<table border="1">';
      echo "<tr> <td>id_buch</td><td>name</td><td>title</td><td>category</td>";
      while ($zeile = mysqli_fetch_array($db_erg_sql_id_book, MYSQLI_ASSOC)) {
        $idCat = $zeile['id_kategorie'];
        $sql_name_category = "SELECT name FROM kategorie WHERE id_kategorie = '$idCat'";
        $db_erg_sql_name_category = mysqli_query($connect, $sql_name_category);
        while ($zeile_name_categrie = mysqli_fetch_array($db_erg_sql_name_category, MYSQLI_ASSOC)) {
          echo "<tr>";
          echo "<td>" . $zeile['id_buch'] . "</td>";
          echo "<td>" . $zeile['name'] . "</td>";
          echo "<td>" . $zeile['title'] . "</td>";
          echo "<td>" . $zeile_name_categrie['name'] . "</td>";

          echo "</tr>";
        }
      }
    }elseif ($kind == "search_id_library" || $kind == "search_name_library") {
      if ($kind == "search_id_library") {
        $id = $_POST['id_library'];
        $sql = "SELECT * FROM bibliothek WHERE id_bibliothek ='$id' ";
      } elseif ($kind == "search_name_library") {
        $name_library = $_POST['name_library'];
        $sql = "SELECT * FROM bibliothek WHERE name ='$name_library' ";
      }
      $db_erg = mysqli_query($connect, $sql);
      if (!$db_erg) {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
      } else {
        print '<table border="1">';
        echo "<tr> <td>id bibliothek</td><td>name</td><td>adresse</td><td>ort</td><td>plz</td>";
        while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
          echo '<br>';
          echo "<tr>";
          echo "<td>" . $zeile['id_bibliothek'] . "</td>";
          echo "<td>" . $zeile['name'] . "</td>";
          echo "<td>" . $zeile['adresse'] . "</td>";
          echo "<td>" . $zeile['ort'] . "</td>";
          echo "<td>" . $zeile['plz'] . "</td>";
          echo "</tr>";
        }
      }
    }elseif ($kind == "search_id_category" || $kind == "search_name_category") {
      if ($kind == "search_id_category") {
        $id_category = $_POST['id_category'];
        $sql = "SELECT * FROM kategorie WHERE id_kategorie ='$id_category'";
      } elseif ($kind == "search_name_category") {
        $name_category = $_POST['name_category'];
        $sql = "SELECT * FROM kategorie WHERE name ='$name_category'";
      }
      $db_erg = mysqli_query($connect, $sql);
      if (!$db_erg) {
        echo "Error: " . $sql . "<br>" . mysqli_error($connect);
      } else {
        print '<table border="1">';
        echo "<tr> <td>id_kategorie</td><td>name</td>";
        while ($zeile = mysqli_fetch_array($db_erg, MYSQLI_ASSOC)) {
          echo '<br>';
          echo "<tr>";
          echo "<td>" . $zeile['id_kategorie'] . "</td>";
          echo "<td>" . $zeile['name'] . "</td>";
          echo "</tr>";
        }
      }
    }
  }else {
    print "keine Verbindung möglich";
  }
}


function insert_into_database($kind)
{
  $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
  if ($connect) {
    global $mitarbeiter, $kunde, $array_zeile;
    if ($kind == "register") {
      if (isset($_POST['client_o_employee'])) {
        if ($_POST['client_o_employee'] == 'employee') {
          $mitarbeiter = 'ja';
          $kunde = 'nein';
        } else {
          $kunde = 'ja';
          $mitarbeiter = 'nein';
        }
        $information = array(1 => $_POST['first_name'], 2 => $_POST['last_name'], 3 => $_POST['Date_of_birth'], 4 => $_POST['address'], 5 => $_POST['place'], 6 => $_POST['postcode'], 7 => $_POST['user_name'], 8 => md5($_POST['password']), 9 => $_POST['email'], 10 => $mitarbeiter, 11 => $kunde);
        if (!in_array(null, $information)) {
          $leer_offset = strpos($_POST['user_name'], ' ');
          if ($leer_offset != true) {
            if (strlen($_POST['password']) > 8) {
              if (!empty(md5($_POST['password'])) && !empty(md5($_POST['password_confirm'])) && md5($_POST['password']) == md5($_POST['password_confirm'])) {
                $sql_username = "SELECT benutzername FROM kunde";
                $db_erg_user = mysqli_query($connect, $sql_username);
                if (!$db_erg_user) {
                  echo "Error: " . $sql_username . "<br>" . mysqli_error($connect);
                }else {
                  while ($zeile = mysqli_fetch_array($db_erg_user, MYSQLI_ASSOC)) {
                    $array_zeile = $zeile['benutzername'];
                    if (!empty($_POST['user_name']) && in_array($_POST['user_name'], explode(',', $array_zeile))) {
                      echo '<tr><td>Benutzername ist bereits verwendet oder schon angemldet</td></tr>';
                      break;
                    }
                  }
                  if (!in_array($_POST['user_name'], explode(',', $array_zeile))) {
                    $sql = "INSERT INTO kunde (`vorname`, `nachname`, `geburtsdatum`, `adresse`, `ort`, `plz`,`benutzername`,`passwort`,`email`,`mitarbeiter`,`kunde`) 
                   VALUES (
                  '{$information[1]}', 
                  '{$information[2]}', 
                  '{$information[3]}', 
                  '{$information[4]}', 
                  '{$information[5]}',
                  '{$information[6]}',
                  '{$information[7]}',
                  '{$information[8]}',
                  '{$information[9]}',
                  '{$information[10]}',
                  '{$information[11]}'
              
                  )";
                  $db_erg = mysqli_query($connect, $sql);
                    if (!$db_erg) {
                      echo "Error: " . $sql . "<br>" . mysqli_error($connect);
                    }else {
                      echo '<tr><td>Hinzugef&uuml;gt Daten</td></tr>';
                    }
                  }
                }
              }else {
                print  '<tr><td>Die Passwort und passwort best&auml;tigen sind nicht gleisch</td></tr>';
              }
            }else {
              print '<tr><td>Passwort muss mehr als 8 zeichen sein</td></tr>';
            }
          }else {
            print '<tr><td>Benutzername hat einen Leerzeichen</td></tr>';
          }
        }else {
          print '<tr><td>Ein Feld oder mehr sind leer</td></tr>';
        }
      }else {
        print '<tr><td>Ein Feld oder mehr sind leer</td></tr>';
      }
    }elseif ($kind == "add_book") {
      $information = array(1 => $_POST['name_book'], 2 => $_POST['title'], 3 => $_POST['categorie_name'], 4 => $_POST['author']);
      if (!in_array(null, $information)) {
            $sql = "INSERT INTO buch (`name`, `title`, `id_kategorie`, `autor`) 
          VALUES (
            '{$information[1]}', 
            '{$information[2]}', 
            '{$information[3]}',
            '{$information[4]}'
            )";
        $db_erg = mysqli_query($connect, $sql);

        if (!$db_erg) {
          echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        } else {
          echo '<tr><td>Hinzugef&uuml;gt Daten</td></tr>';
        }
      }else {
        print '<tr><td>Ein Feld oder mehr sind leer</td></tr>';
      }
    }elseif ($kind == "add_library") {
      $information = array(1 => $_POST['name_library'], 2 => $_POST['address'], 3 => $_POST['area'], 4 => $_POST['Postcode']);
      if (!in_array(null, $information)) {
        $sql = "INSERT INTO bibliothek (`name`, `adresse`, `ort`,`plz`) 
            VALUES (
              '{$information[1]}', 
              '{$information[2]}', 
              '{$information[3]}', 
              '{$information[4]}'              
            )";
        $db_erg = mysqli_query($connect, $sql);
        if (!$db_erg) {
          echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }else {
          echo '<tr><td>Hinzugef&uuml;gt Daten</td></tr>';
        }
      }else {
        print '<tr><td>Ein Feld oder mehr sind leer</td></tr>';
      }

    }elseif ($kind == "add_kategorie") {
      if (!empty($_POST['name_kategorie'])) {
        $name = $_POST['name_kategorie'];
        $sql = "INSERT INTO kategorie (`name`) 
                   VALUES (
                  '$name'                  
              )";
        $db_erg = mysqli_query($connect, $sql);
        if (!$db_erg) {
          echo "Error: " . $sql . "<br>" . mysqli_error($connect);
        }else {
          echo '<tr><td>Hinzugef&uuml;gt Daten</td></tr>';
        }
      }else {
        print '<tr><td>Ein Feld oder mehr sind leer</td></tr>';
      }
    }
  }else {
    print "keine Verbindung möglich";
  }
}


function show_book_to_lend_or_book_to_library()
{
  $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
  global $id_book;
  if (!empty($_POST['book_search'])) {
    $book_feld = $_POST['book_search'];
    $sql_book = "SELECT * FROM buch WHERE name = '$book_feld' ";
  } else {
    $sql_book = "SELECT * FROM buch";
  }
  $db_erg_sql_book = mysqli_query($connect, $sql_book);
  if (!$db_erg_sql_book) {
    echo "Error: " . $db_erg_sql_book . "<br>" . mysqli_error($connect);
  } else {
    if (isset($_POST['show_books']) || isset($_POST['search']) && !empty($_POST['book_search'])) {
      print '<br>';
      print '<table border="1">';
      echo "<tr><td>Name</td><td>Title</td><td>Kategorie</td><td>Autor</td>";
      while ($zeile_book = mysqli_fetch_array($db_erg_sql_book, MYSQLI_ASSOC)) {
        $count_book = $zeile_book ['menge'];
        $id_book = $zeile_book['id_buch'];
        $idCat = $zeile_book['id_kategorie'];
        $sql_name_category = "SELECT name FROM kategorie WHERE id_kategorie = '$idCat'";
        $db_erg_sql_name_category = mysqli_query($connect, $sql_name_category);
        while ($zeile_name_categrie = mysqli_fetch_array($db_erg_sql_name_category, MYSQLI_ASSOC)) {
          if ($count_book == 1) {
            echo "<tr>";
            echo "<td>" . $zeile_book['name'] . "</td>";
            echo "<td>" . $zeile_book['title'] . "</td>";
            echo "<td>" . $zeile_name_categrie['name'] . "</td>";
            echo "<td>" . $zeile_book['autor'] . "</td>";
            echo "<td>" . button_value('ausleihen', 'lend', $id_book) . "</td>";
            echo "</tr>";
          }
        }
      }
      echo "</table>";
    } elseif (isset($_POST['show_book_lend'])) {
      $id_person = $_SESSION ["id"];
      $sql_lend_book_bill = "SELECT id_ausleihe FROM ausleihe WHERE id_kunde = $id_person ";
      $db_erg_sql_lend_book_bill = mysqli_query($connect, $sql_lend_book_bill);
      if (!$db_erg_sql_lend_book_bill) {
        echo "Error: " . $sql_lend_book_bill . "<br>" . mysqli_error($connect);
      } else {
        print '<br>';
        print '<table border="1">';
        echo "<tr><td>Name</td><td>Title</td><td>Kategorie</td><td>Autor</td>";
        while ($zeile_db_erg_sql_lend_book_bill = mysqli_fetch_array($db_erg_sql_lend_book_bill, MYSQLI_ASSOC)) {
          $bill = $zeile_db_erg_sql_lend_book_bill['id_ausleihe'];
          $sql_book_to_lend = "SELECT * FROM buch_to_ausleihe WHERE id_ausleihe = $bill ";
          $db_erg_sql_book_to_lend = mysqli_query($connect, $sql_book_to_lend);
          if (!$db_erg_sql_book_to_lend) {
            echo "Error: " . $sql_book_to_lend . "<br>" . mysqli_error($connect);
          } else {
            while ($zeile_db_erg_db_erg_sql_book_to_lend = mysqli_fetch_array($db_erg_sql_book_to_lend, MYSQLI_ASSOC)) {
              $book_to_lend = $zeile_db_erg_db_erg_sql_book_to_lend ['id_buch'];
              $select_book_from_book_table = "SELECT * FROM buch WHERE id_buch = $book_to_lend ";
              $db_erg_select_book_from_book_table = mysqli_query($connect, $select_book_from_book_table);
              if (!$db_erg_select_book_from_book_table) {
                echo "Error: " . $select_book_from_book_table . "<br>" . mysqli_error($connect);
              } else {

                while ($zeile_book = mysqli_fetch_array($db_erg_sql_book, MYSQLI_ASSOC)) {
                  $count_book = $zeile_book ['menge'];
                  $id_book = $zeile_book['id_buch'];
                  $idCat = $zeile_book['id_kategorie'];
                  $sql_name_category = "SELECT name FROM kategorie WHERE id_kategorie = '$idCat'";
                  $db_erg_sql_name_category = mysqli_query($connect, $sql_name_category);
                  while ($zeile_name_categrie = mysqli_fetch_array($db_erg_sql_name_category, MYSQLI_ASSOC)) {
                    if ($count_book == 0) {
                      echo "<tr>";
                      echo "<td>" . $zeile_book['name'] . "</td>";
                      echo "<td>" . $zeile_book['title'] . "</td>";
                      echo "<td>" . $zeile_name_categrie['name'] . "</td>";
                      echo "<td>" . $zeile_book['autor'] . "</td>";
                      echo "<td>" . button_value('zurück zur Bucherhalle', 'return', $id_book) . "</td>";
                      echo "</tr>";
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}

function lend_or_return()
{
  $connect = mysqli_connect("localhost", "test", "test", "Bibliothek");
  global $id;
  $date = date("Y.m.d");
  $id_person = $_SESSION ["id"];
  if (isset($_POST['lend'])) {
    $sql_update = " UPDATE buch SET
      menge = 0 
      WHERE id_buch = " . $_POST['lend'] . " ";
    $db_erg_sql_book = mysqli_query($connect, $sql_update);
    if (!$db_erg_sql_book) {
      echo "Error: " . $db_erg_sql_book . "<br>" . mysqli_error($connect);
    } else {
      $sql_insert_in_to_lend = "INSERT INTO ausleihe (`id_kunde`,`ausleihdatum`)"
                              ."VALUES ($id_person, '$date') ";
      $db_erg_sql_lend = mysqli_query($connect, $sql_insert_in_to_lend);
      $select_from_ausleihe = "SELECT id_ausleihe FROM ausleihe WHERE id_kunde = $id_person ";
      $db_erg_select_from_ausleihe = mysqli_query($connect, $select_from_ausleihe);
      while ($zeile_id_ausleihe = mysqli_fetch_array($db_erg_select_from_ausleihe, MYSQLI_ASSOC)) {
        $id = $zeile_id_ausleihe ['id_ausleihe'];
      }
      $sql_insert_in_to_book_to_lend = "INSERT INTO buch_to_ausleihe  (`id_ausleihe`,`id_buch`)
                    VALUES (" . $id . " ,'" . $_POST['lend'] . "') ";
      $db_erg_sql_insert_in_to_book_to_lend = mysqli_query($connect, $sql_insert_in_to_book_to_lend);
      if (!$db_erg_sql_insert_in_to_book_to_lend) {
        echo "Error: " . $sql_insert_in_to_book_to_lend . "<br>" . mysqli_error($connect);
      } else {
        echo '<br>';
        print "Wurde Ausgeliehen ";
      }
    }
  } elseif (isset($_POST ['return'])) {
    $id_book = $_POST['return'];
    $sql_update_book = " UPDATE buch SET
        menge = 1
        WHERE id_buch = '$id_book' ";
    $db_erg_sql_update_book = mysqli_query($connect, $sql_update_book);
    if (!$db_erg_sql_update_book) {
      echo "Error: " . $sql_update_book . "<br>" . mysqli_error($connect);
    } else {
      $select_from_book_to_lend = "SELECT * FROM buch_to_ausleihe WHERE id_buch = '$id_book' ";
      $db_erg_select_from_book_to_lend = mysqli_query($connect, $select_from_book_to_lend);
      if (!$db_erg_select_from_book_to_lend) {
        echo "Error: " . $select_from_book_to_lend . "<br>" . mysqli_error($connect);
      } else {
        while ($zeile_id_ausleihe = mysqli_fetch_array($db_erg_select_from_book_to_lend, MYSQLI_ASSOC)) {
          $id_lend_from_book_to_lend = $zeile_id_ausleihe['id_ausleihe'];
        }
        $sql_insert_into_book_to_lend = " UPDATE ausleihe SET
            rückgabedatum = '$date'
            WHERE id_ausleihe = '$id_lend_from_book_to_lend'";
        $db_erg_sql_insert_into_book_to_lend = mysqli_query($connect, $sql_insert_into_book_to_lend);
        if (!$db_erg_sql_insert_into_book_to_lend) {
          echo "Error: " . $sql_insert_into_book_to_lend . "<br>" . mysqli_error($connect);
        } else {
          echo '<br>';
          print "Wurde zurück ";
        }
      }
    }
  }
}

?>