<!-- Strona rejestracji uzytkownika -->
<?php
/**
* wyswietlenie informacji jezeli rejestracja nie powiodlo sie
*/
include('connection.php');
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
  $msg = "Rejestracja nie powiodła się! Proszę wprowadzić prawidłowe dane!";
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
         <li><a class="menu-link" href="contact.php">Kontakt</a></li>
         <li><a class="menu-link" href="employeelogin.php">Dla pracowników</a></li>
         <li><a class="link-button" href="login.php">Zaloguj się</a></li>
         </ul>
         </div>
       </nav>
     </section>
       <section class="main">
       <div class="register-section">
         <h2>Zarejestruj się</h2>
         <div class="login-form">
           <form action="" method="post">
           <input class="login-input" type="text" name="name" placeholder="Imię">
           <input class="login-input" type="text" name="surname" placeholder="Nazwisko">
           <input class="login-input" type="text" name="email" placeholder="E-mail">
           <input class="login-input" type="password" name="password" placeholder="Hasło">
           <input class="login-input" type="password" name="password-repeat" placeholder="Powtórz hasło">
           <input class="login-submit" type="submit" name="login-submit" value="Zarejestruj się">
         </form>
         </div>
         <p class="password-change-info"><?php echo $msg; ?></p>
         <p class="login-p">Posiadasz już konto? <a href="login.php">Zaloguj się</a></p>
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
<?php
/**
* proces rejestracji uzytkownika i wprowadzenie informacji do bazy danych
*/
if(!empty($_POST['name']) and !empty($_POST['surname']) and !empty($_POST['email']) and !empty($_POST['password']) and !empty($_POST['password-repeat']))
{
  openConnection();
  global $serwer;

    if($_POST['password-repeat'] == $_POST['password']){
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_repeat = $_POST['password-repeat'];
    $query = "INSERT INTO `user` (`name`, `surname`, `email`, `password`) VALUES ('$name', '$surname', '$email', '$password');";
    mysqli_query($serwer, $query);
    closeConnection();
    /**
    * jezeli rejestracja sie powiodla przekierowanie na strone logowania
    */
    header("Location: login.php?msg=2");
  }
  else
  {
    header("Location: register.php?msg=1");
  }
}
else{
}
 ?>
