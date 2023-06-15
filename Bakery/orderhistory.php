<!--Strona odpowiedzialna za wyświetlanie zamówień użytkownika-->
<?php
include('connection.php');
session_start();
if(!isset($_SESSION["UserID"])){
  echo '<script>window.location="index.php"</script>';
}
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
          <li><a class="menu-link" href="userpanel.php">Dane konta</a></li>
          <li><a class="menu-link" href="orderhistory.php">Historia zakupów</a></li>
          <li><a class="menu-link" href="cart.php">Koszyk<span class="material-symbols-outlined">shopping_basket</span></a></li>
          </ul>
          </div>
          <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="Wyloguj się"></a>
        </ul>
        </div>
      </nav>
    </section>
    <form method=GET>
      <section class="history-main">
        <div class="history-box">
                <?php
                //ustawianie odpowiednich kolumn dla historii zamówień i pojedynczego zamówienia
                if(isset($_GET["action"]) && $_GET["action"] == "check"){
                    echo '
                    <a class="back-link" href="orderhistory.php">Wróć</a>
                    <h2>Zamówienie nr.'.$_GET['order'].'</h2>
                    <ul>
                      <li><div class="column-cart">
                    <p>Zdjęcie</p>
                  </div>
                  <div class="column-cart">
                    <p>Nazwa</p>
                  </div>
                  <div class="column-cart">
                    <p>Cena</p>
                  </div>
                  <div class="column-cart">
                    <p>Ilość w zamówieniu</p>
                  </div>';
                }
                else{
                    echo '<h2>Historia zamówień</h2>
                    <ul>
                      <li>
                      <div class="column-cart">
                    <p>Numer zamówienia</p>
                  </div>
                  <div class="column-cart">
                    <p>Ilość produktów</p>
                  </div>
                  <div class="column-cart">
                    <p>Cena</p>
                  </div>
                  <div class="column-cart">
                  </div>
                  </li>';
                }
                ?>
              <?php
                openConnection();
                global $serwer;

                echo '<form method=post>';
                //wyświetlanie odpowiednich kolumn dla historii zamówień i pojedynczego zamówienia
                if(isset($_GET["action"]) && $_GET["action"] == "check"){
                    //pobieranie produktów z wybranego zamówienia
                    if(!isset($_SESSION["UserID"])) { echo '<script>window.location="login.php"</script>'; };
                    $zapytanie = "select order.OrderNumber, order.UserID, order.Quantity, order.Price, order.ProductID, product.ImageID, product.Name, product.Price, product.Hashtag, product.ProductID from `order`, `product` where order.UserID=$_GET[id] and order.OrderNumber=$_GET[order] and order.ProductID=product.ProductID";
                    $wynik = mysqli_query($serwer, $zapytanie);
                    if(!$wynik) return;
                    $wiersz = mysqli_fetch_row($wynik);

                    while($wiersz != null){
                        echo
                        '<li>
                        <div class="column-cart">
                            <img src="icons/'.$wiersz[5].'" alt="'.$wiersz[9].'">
                        </div>
                        <div class="column-cart">
                            <p><b>'.$wiersz[6].'</b></p>
                        </div>
                        <div class="column-cart">
                            <p><b>'.$wiersz[3].' zł</b></p>
                        </div>
                        <div class="column-cart">
                            <p><b>'.$wiersz[2].'</b></p>
                        </div>
                        </li>';
                        $wiersz = mysqli_fetch_row($wynik);
                    }
                }
                else{
                    //pobieranie wszystkich zamówień dla zalogowanego użytkownika
                    if(!isset($_SESSION["UserID"])) { echo '<script>window.location="login.php"</script>'; };
                    $zapytanie = "select OrderNumber, UserID, SUM(Quantity) AS QuantitySum, SUM(Price) AS PriceSum from `order` where UserID=$_SESSION[UserID] GROUP BY OrderNumber;";
                    $wynik = mysqli_query($serwer, $zapytanie);
                    if(!$wynik) return;
                    $wiersz = mysqli_fetch_row($wynik);
                    while($wiersz != null){
                        echo
                        '<li>
                        <div class="column-cart">
                            <p><b>'.$wiersz[0].'</b></p>
                        </div>
                        <div class="column-cart">
                            <p><b>'.$wiersz[2].'</b></p>
                        </div>
                        <div class="column-cart">
                            <p><b>'.number_format((float)$wiersz[3], 2, '.', '').' zł</b></p>
                        </div>
                        <div class="column-cart">
                        <div class="buttons-list">
                            <a class="cart-links" href="orderhistory.php?action=check&order='.$wiersz[0].'&id='.$wiersz[1].'">Szczegóły</a>
                        </div>
                        </div>
                        </li>';
                        $wiersz = mysqli_fetch_row($wynik);
                    }
                }
                echo '</form>';
                closeConnection();
               ?>
             </ul>
        </div>
        <?php
        ?>
    </section>
    </form>
  </body>
</html>
