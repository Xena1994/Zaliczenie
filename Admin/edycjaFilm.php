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

$idkat = $_POST["kat"];
$nazwa = $_POST["nazwa"];
$opis = $_POST["opis"];
$rezyser = $_POST["rezyser"];
$scenariusz = $_POST["scenariusz"];
$dataPremiery = $_POST["dataPremiery"];
$cena = floatval($_POST["cena"]);

$sql = "UPDATE film SET idKategoriaFilmu='$idkat', nazwa='$nazwa', opis='$opis', rezyseria='$rezyser', scenariusz='$scenariusz', dataPremiery='$dataPremiery', cenaWypozyczenia='$cena' WHERE id='".$_POST["id"]."'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

header("Location: FilmAdmin.php?id=".$_POST["id"]);
?>

