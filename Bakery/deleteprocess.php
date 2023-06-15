<?php
//strona odpowiada za usuwanie produktu z bazy
$id = $_GET['id'];

include('connection.php');
openConnection();
global $serwer;

$query = "delete from product where ProductID=$id;";
mysqli_query($serwer, $query);
closeConnection();
header('Location: employeeportal.php?message=deletesuccess');

?>
