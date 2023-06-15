<?php
include('connection.php');
//strona odpowiedzialna za edytowanie produktu
$id = $_GET['id'];

openConnection();
global $serwer;

if(isset($_POST['update']))
{
  //pobieranie podanych wartości
  $name = $_POST['name'];
  $price = $_POST['price'];
  $amount = $_POST['amount'];
  $glaze = $_POST['glaze-list'];
  $sprinkle = $_POST['sprinkle-list'];
  $filling = $_POST['filling-list'];

  //zmiana wartości z kolumn tabeli 'product' na nowe
  $query = "update product set Name='$name', Price='$price', AmountOnStock='$amount', Glaze='$glaze', Sprinkle='$sprinkle', Filling='$filling' where ProductID=$id;";
  mysqli_query($serwer, $query);
  closeConnection();
  header('Location: employeeportal.php?message=editsuccess');
}
?>
