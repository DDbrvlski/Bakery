<!-- strona z danymi zalogowanego uzytkownika -->
<?php
/**
*wyswietlenie informacji jezeli zmiana danych lub hasla przebiegly prawidlowo
*/
include('connection.php');
session_start();
if(!isset($_SESSION["UserID"])){
  echo '<script>window.location="index.php"</script>';
}
if (isset($_GET['message'])) {
  $messageID = $_GET['message'];
}
else {
  $messageID = 0;
}
switch ($messageID) {
  case 0:
    $message = "";
    break;
  case 1:
    $message = "Hasło zostało zmienione!";
    break;
      case 2:
        $message = "Dane użytkownika zostały zmienione!";
        break;
  default:
    $message = "";
    break;
}
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
  <body>
  <section class="header">
    <nav>
      <a href="index.php"><img src="icons/DonutHouseLogo.png" alt="Donut House Logo"></a>
      <div class="nav-links" id="navLinks">
      <ul>
      <li><a class="menu-link" href="index.php">Strona Główna</a></li>
      <li><a class="menu-link" href="menu.php">Menu</a></li>
      <li><a class="menu-link" href="userpanel.php">Dane konta</a></li>
      <li><a class="menu-link" href="orderhistory.php">Historia zakupów</a></li>
      <li><a class="menu-link" href="cart.php">Koszyk<span class="material-symbols-outlined">shopping_basket</span></a></li>
      </ul>
      </div>
      <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="Wyloguj się"></a>
    </nav>
    <?php
    /**
    *wyswietlenie danych o uzytkowniku z bazy danych
    */
        openConnection();
        global $serwer;
            try{
        	  $zapytanie = "select Name, Surname, email from user where UserID=$_SESSION[UserID]";
        	  $wynik = mysqli_fetch_array(mysqli_query($serwer, $zapytanie));
        	  if(!$wynik) return;
              $_SESSION["name"] = $wynik[0]." ".$wynik[1];
              $_SESSION["email"] = $wynik[2];
              closeConnection();
            }
            catch(Exception){
                session_destroy();
                closeConnection();
                header('Location: login.php');
                exit();
            }
         ?>
  </section>
    <section class="main">
    <div class="userpanel-section">
      <h2>Dane konta</h2>
      <h3>Imię i nazwisko</h3>
      <p><?=$_SESSION["name"]?></p>
      <h3>Adres e-mail</h3>
      <p><?=$_SESSION["email"]?></p>
      <p class="p-info"><?php echo $message; ?></p>
      <div class="userpanel-buttons">
      <a href="userpanel_edit.php">Edytuj dane</a>
      <a href="userpanel_password.php">Zmień hasło</a>
    </div>
    </div>
  </section>
  <section class="footer">
    <div class="column-footer">
      <a href="index.php"><img class="logo" src="icons/DonutHouseLogo.png" alt="Donut House Logo"></a>
    </div>
    <div class="column-footer">
      <p>Lokalizacja<br><i>ul. Testowa 14a<br>03-330 Warszawa</i></p>
    </div>
    <div class="column-footer">
      <p>Kontakt<br><i>+48788677677<br>donuthousewawa@gmail.com</i></p>
    </div>
    <div class="column-footer">
      <p>Social Media</p>
      <div class="social-icons">
        <img src="icons/whatsappIcon.png" alt="Whatsapp">
        <img src="icons/instagramIcon.png" alt="Instagram">
        <img src="icons/facebookIcon.png" alt="Facebook">
        <img src="icons/twitterIcon.png" alt="Twitter">
      </div>
    </div>
  </section>
  </body>
</html>
