<?php
include('connection.php');
//strona odpowiedzialna za edytowanie użytkownika
session_start();
openConnection();
global $serwer;

if(isset($_POST['update']))
{
    //pobieranie podanych wartości
    $fullname = explode(" ", $_POST['name']);
    $name = $fullname[0];
    $surname = $fullname[1];
    $email = $_POST['email'];

    //zmiana wartości z kolumn tabeli 'user' na nowe
    $query = "update user set Name='$name', Surname='$surname', email='$email' where UserID=$_SESSION[UserID]";
    mysqli_query($serwer, $query);
    closeConnection();
    header('Location: userpanel.php?message=2');
}
?>
