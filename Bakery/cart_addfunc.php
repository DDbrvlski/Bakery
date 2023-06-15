<?php
//funkcja odpowiada za dodawanie produktu do koszyka
function addToCart($element, $quantity){
    global $serwer;
    $zapytanie = "select ImageID, Name, Price, Hashtag, ProductID, AmountOnStock from product where ProductID=$element";
    $wynik = mysqli_query($serwer, $zapytanie);
    $wiersz = mysqli_fetch_row($wynik);
    //sprawdzanie czy zamawiana ilość nie jest większa niż ilość dostępnych produktów
    if($wiersz[5] < $quantity){
        echo '<script>alert("Nie ma tylu produktów w magazynie, maksymalna możliwa ilość na ten moment wynosi: '.$wiersz[5].'")</script>';
    }
    else{
        //sprawdzanie czy koszyk istnieje, w przeciwnym wypadku tworzenie go
        if(isset($_SESSION['cart'])) {
            $itemArrayID = array_column($_SESSION['cart'],"ProductID");
            //sprawdzanie czy dodawany produkt już jest w koszyku poprzez przeszukiwanie
            //kolumny ProductID z koszyka w celu znalezienia czy dodawane id produktu już tam jest
            if(!in_array($wiersz[4],$itemArrayID)){
                $count = count($_SESSION['cart']);
                $item = array("ImageID"=>$wiersz[0],"Name"=>$wiersz[1],"Price"=>$wiersz[2],"Hashtag"=>$wiersz[3],"ProductID"=>$wiersz[4],"Quantity"=>$quantity,"AmountOnStock"=>$wiersz[5]);
                $_SESSION['cart'][$count] = $item;
                echo '<script>window.location="menu.php?msg=1"</script>';
            }
            else{
                echo '<script>window.location="menu.php?msg=2"</script>';
            }
        }
        else{
            $_SESSION['cart'][0] = array("ImageID"=>$wiersz[0],"Name"=>$wiersz[1],"Price"=>$wiersz[2],"Hashtag"=>$wiersz[3],"ProductID"=>$wiersz[4],"Quantity"=>$quantity, "AmountOnStock"=>$wiersz[5]);
            echo '<script>window.location="menu.php?msg=1"</script>';
        }
    }
}
?>
