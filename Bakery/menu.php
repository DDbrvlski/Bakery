<!-- Strona z menu restauracji -->
<?php
/**
* funkcja dodajaca produkt do koszyka
*/
include('cart_addfunc.php');
include('connection.php');
session_start();
if(isset($_SESSION["EmployeeID"])){
   echo '<script>window.location="index.php"</script>';
}
/**
* wyswietlenie informacji dla uzytkownika jezeli produkt zostal dodany lub wystapil blad(stan magazynu)
*/
if(isset($_GET['msg']))
{
  $messageID = $_GET['msg'];
}else{
  $messageID = 0;
}
switch ($messageID) {
  case 0:
    $msg = "";
    break;
    case 1:
      $msg = "Produkt został dodany do koszyka! ";
      break;
      case 2:
        $msg = "Nie można dodać produktu!";
        break;
  default:
    $msg = "";
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
        <?php
        /**
        * zmiana nawigacji w zaleznosci czy uzytkownik jest zalogowany lub nie
        */
        if(isset($_SESSION["UserID"])){
          echo '<li><a class="menu-link" href="userpanel.php">Dane konta</a></li>
          <li><a class="menu-link" href="orderhistory.php">Historia zakupów</a></li>
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
    <section class="banner">
      <h1>Menu</h1>
    </section>
    <section class="menu">
      <p class="info-menu"><?php echo $msg; ?></p>
      <div class="menu-list">
        <?php
        /**
      * wyswietlenie wszystkich produktow na stanie restauracji z bazy danych
      */
      openConnection();
      global $serwer;
        	$zapytanie = "select ImageID, Name, Price, Hashtag, ProductID, AmountOnStock from product";
        	$wynik = mysqli_query($serwer, $zapytanie);
        	if(!$wynik) return;
          echo '<form class="menu-list-form" method=POST action=>';
          //pętla wyświetlająca wszystkie produkty z bazy
        	while($wiersz = mysqli_fetch_row($wynik))
          {
            if($wiersz[5] > 0){
              echo '
              <div class="product">
              <a href="product_description.php?id='.$wiersz[4].'">
                <img src="icons/'.$wiersz[0].'" alt="'.$wiersz[3].'">
                <p class="title-product">'. $wiersz[1] .'</p>
                <p class="price-product">'.$wiersz[2].' zł</p>
                </a>
                <button class="add-button" type="submit" name="button['.$wiersz[4].']" value="Dodaj">Dodaj do koszyka</button>
              </div>
              ';
            }
        	}
          echo '</form>';
        	mysqli_free_result($wynik);
         ?>
      </div>
    </section>
    <?php
    /**
    * dodanie produktu do koszyka
    */
    $request='';
    if(isset($_POST["button"])) {
      session_start();
      if(isset($_SESSION["UserID"])) {
      $nr = key($_POST["button"]);
      $request = $_POST["button"][$nr];
      }
      else{
        echo '<script>window.location="login.php"</script>';
      }
    }
    switch($request) {
      case "Dodaj": addToCart($nr,1); break;
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
