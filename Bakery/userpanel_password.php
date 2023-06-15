<!-- Strona do zmiany hasla uzytkownika -->
<?php
/**
*wyswietlenie informacji o bledach podczas zmiany procesu zmiany hasla
*/
session_start();
if(!isset($_SESSION["UserID"])){
  echo '<script>window.location="index.php"</script>';
}
if (isset($_GET['message'])) {
  $messageID = $_GET['message'];
}
else {
  $messageID = 1;
}
switch ($messageID) {
  case 1:
    $message = "";
    break;
      case 2:
        $message = "Podane hasła różnią się od siebie!";
        break;
        case 3:
          $message = "Podane hasło jest nieprawidłowe!";
          break;
          case 4:
            $message = "Nie wypełniono wszystkich wymaganych pól!";
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
      <li><a class="menu-link" href="contact.php">Historia zakupów</a></li>
      <li><a class="menu-link" href="cart.php">Koszyk<span class="material-symbols-outlined">shopping_basket</span></a></li>
      </ul>
      </div>
      <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="Wyloguj się"></a>
    </nav>
  </section>
    <section class="main">
    <div class="userpanel-section">
      <h2>Zmień hasło</h2>
      <form class="userpanel-form" action="editpasswordprocess.php" method="post">
      <h4>Obecne hasło</h4>
      <input type="password" name="oldpassword">
      <h4>Nowe hasło</h4>
      <input type="password" name="newpassword">
      <h4>Powtórz hasło</h4>
      <input type="password" name="repeatpassword"><br>
      <p class="password-change-info"><?php echo $message; ?></p>
      <input type="submit" name="changepassword" value="Zapisz">
      </form>
      <a class="cancel-button" href="userpanel.php">Anuluj</a>
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
