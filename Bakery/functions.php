<?php
//strona z funkcjami do tworzenia listy wyboru
//$getElements - tabela
//$name - nazwa listy wyboru
//$ID - nazwa klucza z tabeli

//tworzenie nowej listy wyboru
function newList($getElements, $name, $ID){
    echo '<select name='.$name.'>';
    while($elemenets = mysqli_fetch_array($getElements)){
        echo "<option value='$elemenets[$ID]'>$elemenets[Name]</option>";
      }
        mysqli_free_result($getElements);
    echo'</select>';
  }

//tworzenie nowej listy wyboru z wybranym już elementem podanym w argumencie $selectedID
function selectedList($getElements, $name, $ID, $selectedID){
    echo '<select name='.$name.'>';
    while($elemenets = mysqli_fetch_array($getElements)){
        if($selectedID == $elemenets['Name']){
            echo "<option selected='selected' value='$elemenets[$ID]'>$elemenets[Name]</option>";
        }
        else echo "<option value='$elemenets[$ID]'>$elemenets[Name]</option>";
      }
        mysqli_free_result($getElements);
    echo'</select>';
  }
?>