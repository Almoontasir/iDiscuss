<?php
$servername = "localhost";
$username = "root";
$password ="";
$database = "idiscuss";
try{
    $conn = mysqli_connect($servername,$username,$password,$database);

}
catch(mysqli_sql_exception $e){
    die("Could not connect to the server due to that error->".mysqli_connect_error());
}
?>