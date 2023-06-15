<?php
//strona odpowiada za niszczenie sesji - wylogowywanie użytkownika
session_start();
session_destroy();
header('Location: index.php');
exit();
?>