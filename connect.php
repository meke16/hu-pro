<?php 

$conn = new mysqli("localhost" , "root" , "Adey@@1997" ,"hu" );

if(!$conn) {
    echo die("". mysqli_error($conn));
}
?>
