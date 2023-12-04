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

$idKategoriaFilmu = $_POST["kategoria"];
$sql;

if($idKategoriaFilmu === "ALL") { 
    $sql = "SELECT id, plakat, nazwa, cenaWypozyczenia FROM film WHERE nazwa LIKE '%".$_POST["nazwa"]."%'";
} else { 
    $sql = "SELECT id, plakat, nazwa, cenaWypozyczenia FROM film WHERE nazwa LIKE '%".$_POST["nazwa"]."%' AND idKategoriaFilmu='$idKategoriaFilmu'";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<div id='plakat'>";
        echo    "<a href='Film.php?id=".$row["id"]."&idUser=".$_POST["idUser"]."'><img src='../Plakaty/" . $row["plakat"] . "' width='200px' height='300px'></a><br>";
        echo    "<a href='Film.php?id=".$row["id"]."&idUser=".$_POST["idUser"]."'>" . $row["nazwa"] . "</a><br>";

        $selectCount = "SELECT id FROM wypozyczenie WHERE idFilmu='".$row["id"]."' AND idUzytkownik='".$_POST["idUser"]."'";
        $resultSelect = $conn->query($selectCount);
        if($resultSelect->num_rows > 0) { 
            echo "<p> Wypożyczono </p>";    
        } else { 
            echo "<button class='submitLong' data-idfilm='".$row["id"]."' data-iduser='".$_POST["idUser"]."' data-cenafilm='".$row["cenaWypozyczenia"]."'> Wypożycz film </button>";
        }
        echo "</div>";
    }
} else { 
    echo "Nie znaleziono poszukiwanego filmu ";
}

?>