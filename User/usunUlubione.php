<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bazazaliczenie";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "DELETE FROM ulubione WHERE idFilm='".$_POST["idFilm"]."' AND idUzytkownik='".$_POST["idUser"]."'";

if ($conn->query($sql) === TRUE) {
    echo "Usunięto z ulubionych";
} else {
    echo "Bład podczas usuwania: " . $conn->error;
}

$conn->close();

?>