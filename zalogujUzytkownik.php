<?php

if($_POST["name"] == "admin" && $_POST["password"] == "admin") { 
    header("Location: Admin/daneFilmowAdmin.php");
} else { 
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

    $sql = "SELECT id FROM uzytkownik WHERE (nazwa='".$_POST["name"]."' AND haslo='".$_POST["password"]."')";
    $result = $conn->query($sql);
    $idUzytkownik;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $idUzytkownik = $row["id"];
        }
        $conn->close();
        header('Location: User/katalogFilm.php?idUser='.$idUzytkownik.'&name='.$_POST["name"]);
    } else {
        $conn->close();
        echo '<script language="javascript">';
        echo 'alert("Podałeś niepoprawne hasło!")
            window.location.href="index.php";';
        echo '</script>';
    }
}
?>