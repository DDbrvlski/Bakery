<!-- Strona z edycja danych zalogowanego uzytkownika -->
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
    <?php
    /**
    *edycja danych uzytkownika wedlug danych z aktywnej sesji
    */
        session_start();
        if(!isset($_SESSION["UserID"])){
          echo '<script>window.location="index.php"</script>';
        }
         ?>
  </section>
    <section class="main">
    <div class="userpanel-section">
      <h2>Edytuj swoje dane</h2>
      <form class="userpanel-form" action="edituserprocess.php" method="post">
      <h3>Imię i nazwisko</h3>
      <input type="text" name="name" value="<?=$_SESSION['name']?>">
      <h3>Adres e-mail</h3>
      <input type="text" name="email" value="<?=$_SESSION['email']?>"><br>
      <input type="submit" name="update" value="Zapisz">
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
