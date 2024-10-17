<?php 
// connecting to data base
$connct = mysqli_connect('localhost','Ammani','','ninja_pizza');
// checking if the connection is good
if(!$connct){
       echo'connection failed'. mysqli_connect_error();
}
?>