<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bazazaliczenie";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idFilm = $_POST["idFilm"];
$cenaFilm = $_POST["cenaFilm"];
$idUzytkownik = $_POST["idUser"];


$sql = "INSERT INTO wypozyczenie (idFilmu, idUzytkownik, cenaWypozyczenia)
    VALUES ('$idFilm', '$idUzytkownik', '$cenaFilm')";

if ($conn->query($sql) === TRUE) {
    echo "Wypożyczono film";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 