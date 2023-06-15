<!-- Strona dla pracownika do edycji danego produktu -->
<?php
/**
*sprawdzenie sesji dla zalogowanego pracownika jezeli nie odsylanie do logowania
*/
include("functions.php");
include('connection.php');

session_start();
if(!isset($_SESSION["EmployeeID"])) {
  header('Location: employeelogin.php');
}
?>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="style.css">
<link href="https://fonts.googleapis.com/css2?family=Rubik:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
  <body>
  <?php
    $id = $_GET['id'];
  ?>
    <section class="header">
      <nav>
        <a href="index.php"><img src="icons/DonutHouseLogo.png" alt="Donut House Logo"></a>
        <div class="nav-links" id="navLinks">
        <ul>
        <li><a class="menu-link" href="index.php">Strona Główna</a></li>
        <li><a class="menu-link" href="employeeportal.php">Obsługa produktów</a></li>
        <li><a class="menu-link" href="employeeportal_addproduct.php">Dodaj nowy produkt</a></li>
        <li class="username"><?=$_SESSION["EmployeeName"]?></li>
        </ul>
        </div>
        <a href="clearsession.php"><img class="image-logout" src="icons/logoutIcon.png" alt="Wyloguj się"></a>
      </nav>
    </section>
      <section class="main-edit">
        <div class="options-edit">
          <h2>Edytuj produkt</h2>
          <ul>
            <?php
            /**
            *wyswietlenie informacji o wybranym produkcie z bazy danych wedlug jego ID oraz update informacji o produkcie w bazie
            */
              $id = $_GET['id'];

              openConnection();
              global $serwer;
              //pobieranie danych produktu z bazy
              $zapytanie = "select product.ImageID, product.Name, product.Price, product.AmountOnStock, glaze.Name, sprinkle.Name, filling.Name, product.Hashtag, product.ProductID from product,sprinkle,filling,glaze where ProductID=$id && sprinkle.SprinkleID=Sprinkle && filling.FillingID=Filling && glaze.GlazeID=Glaze";
              $getGlaze = mysqli_query($serwer, "SELECT * FROM glaze");
              $getSprinkle = mysqli_query($serwer, "SELECT * FROM sprinkle");
              $getFilling = mysqli_query($serwer, "SELECT * FROM filling");
              $wynik = mysqli_query($serwer, $zapytanie);
              if(!$wynik) return;

              $wiersz = mysqli_fetch_row($wynik);
              ?>
                <li>
                <form class="form-edit" action="editprocess.php?id=<?=$wiersz[8]?>" method="post">
               <div class="column-edit">
                 <img src="icons/<?=$wiersz[0]?>" alt="<?=$wiersz[7]?>">
               </div>
               <div class="column-edit">
               <p class="column-p">Nazwa:</p>
               <input type="text" name="name" value="<?=$wiersz[1]?>">
               </div>
               <div class="column-edit">
               <p class="column-p">Cena:</p>
               <input type="text" name="price" value="<?=$wiersz[2]?>">
               </div>
               <div class="column-edit">
               <p class="column-p">Ilość na stanie:</p>
               <input type="text" name="amount" value="<?=$wiersz[3]?>">
               </div>
               <div class="column-edit">
               <p class="column-p">Polewa:</p>
               <!--tworzenie listy wyboru za pomoca funkcji 'selectedList'-->
                <?=selectedList($getGlaze,'glaze-list','GlazeID',$wiersz[4])?>
               </div>
               <div class="column-edit">
               <p class="column-p">Posypka:</p>
               <!--tworzenie listy wyboru za pomoca funkcji 'selectedList'-->
                <?=selectedList($getSprinkle,'sprinkle-list','SprinkleID',$wiersz[5])?>
               </div>
               <div class="column-edit">
               <p class="column-p">Nadzienie:</p>
               <!--tworzenie listy wyboru za pomoca funkcji 'selectedList'-->
                <?=selectedList($getFilling,'filling-list','FillingID',$wiersz[6])?>
               </div>
               <div class="save-column">
                   <input type="submit" name="update" value="Zapisz">
               </div>
               </form>
             </li>
             <?php
             mysqli_free_result($wynik);
             closeConnection();
              ?>
          </ul>
        </div>
    </section>
  </body>
</html>
