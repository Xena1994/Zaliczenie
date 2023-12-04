<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bazazaliczenie";


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idFilm = $_POST["idFilm"];
$idUzytkownik = $_POST["idUser"];
$date = date("Y/m/d h:i:sa");

$sql = "INSERT INTO ulubione (idFilm, idUzytkownik, data)
    VALUES ('$idFilm', '$idUzytkownik', '$date')";

if ($conn->query($sql) === TRUE) {
    echo "Dodano do ulubionych!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>