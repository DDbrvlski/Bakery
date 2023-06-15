<?php
include('connection.php');
//strona odpowiada za zmianę hasła użytkownika
session_start();
openConnection();
global $serwer;

if(isset($_POST['changepassword']))
{
  if(!empty($_POST['oldpassword']) and !empty($_POST['newpassword']) and !empty($_POST['repeatpassword']))
  {
    //pobieranie aktualnego hasła użytkownika
    $getPassword = mysqli_fetch_array(mysqli_query($serwer, "SELECT Password FROM user WHERE UserID=$_SESSION[UserID]"));
    $userPassword = $getPassword[0];
    //sprawdzanie czy użytkownik przy zmianie podał poprawne stare hasło
    if($_POST['oldpassword'] == $userPassword)
    {
      //sprawdzanie czy użytkownik przy zmianie podał dwa razy to samo nowe hasło
      if($_POST['newpassword'] == $_POST['repeatpassword'])
      {
        //zmiana wartości w kolumnie 'password' dla użytkownika na nową
        $password = $_POST['newpassword'];
        $query = "update user set Password='$password' where UserID=$_SESSION[UserID]";
        mysqli_query($serwer, $query);
        closeConnection();
        header('Location: userpanel.php?message=1');
      }
      else {
        header('Location: userpanel_password.php?message=2');
      }
    }
    else{
      header('Location: userpanel_password.php?message=3');
    }
  }
  else{
    header('Location: userpanel_password.php?message=4');
  }
}
?>
