<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bazazaliczenie";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id FROM wypozyczenie WHERE idFilmu='".$_POST["idFilm"]."' AND idUzytkownik='".$_POST["idUser"]."'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "TRUE";
} else { 
    echo "FALSE";
}
?>