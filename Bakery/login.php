<!-- Strona logowania uzytkownika -->
<?php
/**
* wyswietlenie informacji jezeli logowanie nie powiodlo sie lub pomyslnie zarejestrowano uzytkownika
*/
include('connection.php');
session_start();
if(isset($_SESSION["UserID"]) || isset($_SESSION["EmployeeID"])){
  echo '<script>window.location="index.php"</script>';
}

if(isset($_GET['msg']))
{
  $messageID = $_GET['msg'];
}else{
  $messageID = 0;
}

if($messageID == 1)
{
  $msg = "Nieprawidłowe dane logowania!";
}
else if($messageID == 2)
{
  $msg = "Pomyślnie zarejstrowano użytkownika! Można się teraz zalogować.";
}
else{
  $msg = "";
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
    <section class="header">
      <nav>
        <a href="index.php"><img src="icons/DonutHouseLogo.png" alt="Donut House Logo"></a>
        <div class="nav-links" id="navLinks">
        <ul>
        <li><a class="menu-link" href="index.php">Strona Główna</a></li>
        <li><a class="menu-link" href="menu.php">Menu</a></li>
        <li><a class="menu-link" href="employeelogin.php">Dla pracowników</a></li>
        <li><a class="link-button" href="login.php">Zaloguj się</a></li>
        </ul>
        </div>
      </nav>
    </section>
      <section class="main">
      <div class="login-section">
        <h2>Zaloguj się</h2>
        <div class="login-form">
          <form method=POST action="">
          <input class="login-input" type="text" name="email" placeholder="E-mail">
          <input class="login-input" type="password" name="password" placeholder="Hasło">
          <input class="login-submit" type="submit" name="login-submit" value="Zaloguj się">
        </form>
        </div>
        <p style="color:purple;"><?php echo $msg; ?></p>
        <p class="login-p">Nie posiadasz jeszcze konta? <a href="register.php">Zarejestruj się</a></p>
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
      <div class="column-footer"
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
<?php
/**
* proces logowania uzytkownika wedlug informacji z bazy danych
*/
if(!empty($_POST['email']) and !empty($_POST['password']))
{
  openConnection();
  global $serwer;

  //pobieranie podanych wartości
  $email = $_POST['email'];
  $password = $_POST['password'];

  //pobieranie hasła użytkownika z bazy dla podanego emaila
  $getPassword = mysqli_fetch_array(mysqli_query($serwer, "SELECT Password FROM user WHERE email = '$email'"));
  $userPassword = $getPassword[0];

  //porównywanie podanego hasła z hasłem z bazy
  if($password == $userPassword)
  {
    $getInfo = mysqli_fetch_array(mysqli_query($serwer, "SELECT UserID FROM user WHERE email = '$email'"));
    /**
    * rozpoczecie sesji dla zalogowanego uzytkownika i przekierowanie na strone glowna
    */
    $_SESSION["UserID"] = $getInfo[0];
    header('Location:index.php');
  }else {
    header('Location:login.php?msg=1');
  }
  closeConnection();
}
else {
}
 ?>
