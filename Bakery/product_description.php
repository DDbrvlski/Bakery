<?php
/**
* wyswietlenie informacji o produkcie wedlug podanego id produktu podczas przekierowania
*/
session_start();
$id = $_GET['id'];
include('connection.php');
if(isset($_SESSION["EmployeeID"])){
   echo '<script>window.location="index.php"</script>';
}
/**
* plik z funkcja dodajaca produkt do koszyka w obecnej sesji
*/
include('cart_addfunc.php');
 ?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
  <body>
    <section class="header">
      <nav>
        <a href="index.php"><img src="icons/DonutHouseLogo.png" alt="Donut House Logo"></a>
        <div class="nav-links" id="navLinks">
        <ul>
        <li><a class="menu-link" href="index.php">Strona Główna</a></li>
        <li><a class="menu-link" href="menu.php">Menu</a></li>
        <?php
        if(isset($_SESSION["UserID"])){
          echo '<li><a class="menu-link" href="userpanel.php">Dane konta</a></li>
          <li><a class="menu-link" href="contact.php">Historia zakupów</a></li>
          <li><a class="menu-link" href="cart.php">Koszyk<span class="material-symbols-outlined">shopping_basket</span></a></li>
          </ul>
          </div>
          <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="Wyloguj się"></a>';
        }
        else{
          echo '<li><a class="menu-link" href="employeelogin.php">Dla pracowników</a></li>
          <li><a class="menu-link" href="login.php">Koszyk<span class="material-symbols-outlined">shopping_basket</span></a></li>
          <li><a class="link-button" href="login.php">Zaloguj się</a></li>
          </ul>
          </div>';
        }
        ?>
      </nav>
    </section>
    <section class="product-ui">
      <div class="window-product">
          <a href="menu.php">Powrót do menu</a>
          <div class="product-row">
            <?php
            /**
            *pobranie z bazy danych informacji o produkcie wedlug ID i wyswietlnie ich
            */
            $id = $_GET['id'];
            openConnection();
            global $serwer;

              $zapytanie = "select product.ImageID, product.Name, product.Price, product.AmountOnStock, glaze.Name, sprinkle.Name, filling.Name, product.Hashtag, product.ProductID from product,sprinkle,filling,glaze where ProductID=$id && sprinkle.SprinkleID=Sprinkle && filling.FillingID=Filling && glaze.GlazeID=Glaze";
              $wynik = mysqli_query($serwer, $zapytanie);
              if(!$wynik) return;
              $wiersz = mysqli_fetch_row($wynik);
                echo'
                <img src="icons/'.$wiersz[0].'" alt="'.$wiersz[7].'">
                <div class="info-panel">
                  <h3>'.$wiersz[1].'</h3>
                  <p>'.$wiersz[2].' zł</p>
                  <h4>Dodatki:</h4>
                  <p>Polewa: '.$wiersz[4].'</p>
                  <p>Posypka: '.$wiersz[5].'</p>
                  <p>Nadzienie: '.$wiersz[6].'</p>
                  <form class="add-form-order" action="" method="post">
                    <input type="number" name="amount" min="1" max='.$wiersz[3].'>
                    <input type="submit" name="submit" value="Dodaj">
                  </form>
                </div>
                ';
             ?>
        </div>
      </div>
    </section>
    <?php
    /**
    *dodanie danego produktu oraz jego ilosci do koszyka - funkcja dodajaca addToCart
    */
    $request='';
    if(isset($_POST["submit"])) {
      if(isset($_SESSION["UserID"])) {
        $nr = $wiersz[8];
        $amount = $_POST["amount"];
        $request = "Dodaj";
      }
      else{
        header('Location: login.php');
      }
      
    }
    switch($request) {
      case "Dodaj": addToCart($nr,$amount); break;
    }
    closeConnection();
    ?>
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
