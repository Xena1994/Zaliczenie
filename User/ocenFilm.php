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
$idUzytkownik = $_POST["idUzytkownik"];
$ocena = intval($_POST["ocena"]);
$date = date("Y/m/d h:i:sa");


$sql = "SELECT id FROM ocena where idFilm='$idFilm' AND idUzytkownik='$idUzytkownik'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $idUpdate;
    while ($row = $result->fetch_assoc()) {
        $idUpdate = $row["id"];
    }
    $sql = "UPDATE ocena SET idFilm='$idFilm', idUzytkownik='$idUzytkownik', ocena='$ocena', data='$date' WHERE id='$idUpdate'";
    
    if ($conn->query($sql) === TRUE) {
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    
} else { 
    $sql = "INSERT INTO ocena (idFilm, idUzytkownik, ocena, data)
    VALUES ('$idFilm', '$idUzytkownik', '$ocena', '$date')";

    if ($conn->query($sql) === TRUE) {
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();

echo "<script language='javascript'>";
echo "alert('Dodano ocenę!')
    window.location.href='Film.php?id=$idFilm&idUser=$idUzytkownik';";
echo '</script>';
?>