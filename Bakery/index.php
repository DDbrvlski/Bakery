<!-- Strona główna strony -->
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
        <?php
        /**
        * utworzenie elementów nawigacji na stronie w zależności czy sesja jest dla użytkownika zalogowanego, niezalogowanego lub pracownika
        */
        session_start();
        if(isset($_SESSION["UserID"])){
          echo '
          <li><a class="menu-link" href="menu.php">Menu</a></li>
          <li><a class="menu-link" href="userpanel.php">Dane konta</a></li>
          <li><a class="menu-link" href="orderhistory.php">Historia zakupów</a></li>
          <li><a class="menu-link" href="cart.php">Koszyk<span class="material-symbols-outlined">shopping_basket</span></a></li>
          </ul>
          </div>
          <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="Wyloguj się"></a>';
        }
        else if(isset($_SESSION["EmployeeID"])){
          echo '<li><a class="menu-link" href="employeeportal.php">Obsługa produktów</a></li>
          <li><a class="menu-link" href="employeeportal_addproduct.php">Dodaj nowy produkt</a></li>
          <li class="username">'.$_SESSION["EmployeeName"].'</li>
          </ul>
          </div>
          <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="Wyloguj się"></a>';
        }
        else{
          echo '
          <li><a class="menu-link" href="menu.php">Menu</a></li>
          <li><a class="menu-link" href="employeelogin.php">Dla pracowników</a></li>
          <li><a class="menu-link" href="login.php">Koszyk<span class="material-symbols-outlined">shopping_basket</span></a></li>
          <li><a class="link-button" href="login.php">Zaloguj się</a></li>
          </ul>
          </div>';
        }
        ?>
      </nav>
    </section>
      <section class="main-index">
        <div class="text-box">
          <h1>Zamów Online</h1>
          <p>Zamów swoje ulubione donuty<br> już dziś a my dostarczymy je do Twojego domu!</p>
            <a href="menu.php" class="link-button">Złoż zamówienie</a>
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
