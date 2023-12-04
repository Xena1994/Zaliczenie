<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="CSS/wyswietlInformacjeCSS.css">
    </head>
    <body>
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
        
        echo "<div class='topnav'>";
        echo    "<a href='wypozyczenia.php?idUser=".$_GET["idUser"]."'> Wypożyczenia </a>";        
        echo    "<a href='katalogFilm.php?idUser=".$_GET["idUser"]."'> Filmy </a>";
        echo    "<a href='wyswietlInformacje.php?idUser=".$_GET["idUser"]."'> Użytkownik </a>";
        echo    "<a href='../index.php'> Wyloguj </a>";
        echo "</div>";
        
        echo "<table id='lightbox'>";
        echo    "<thead>";
        echo        "<tr>";
        echo            "<th> Nazwa użytkownika </th>";
        echo            "<th> Hasło </th>";
        echo            "<th> Email </th>";
        echo        "</tr>";
        echo    "</thead>";
        echo    "<tbody>";

        $sql = "SELECT * FROM uzytkownik WHERE id='".$_GET["idUser"]."'";
        $result = $conn->query($sql);
        $idUzytkownik;
        
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo    "<td>" . $row["nazwa"] . "</td>";
                echo    "<td>" . $row["haslo"] . "</td>";
                echo    "<td>" . $row["email"] . "</td>";
                echo "</tr>";
                $idUzytkownik = $row["id"];
            }
        }
        echo "</tbody>";
        echo "</table>";
        
        echo "<h1 id='headerTwo'> Ulubione filmy </h1>";
        
        echo "<div id='lightboxTwo'>";

        $sql = "SELECT f.id, f.plakat, f.nazwa FROM film f, ulubione u WHERE u.idUzytkownik='" . $_GET["idUser"] . "' AND u.idFilm = f.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div id='plakat'>";
                echo "<a href='Film.php?id=" . $row["id"] . "&idUser=".$_GET["idUser"]."'><img src='../Plakaty/" . $row["plakat"] . "' width='200px' height='300px'></a><br>";
                echo "<a href='Film.php?id=" . $row["id"] . "&idUser=".$_GET["idUser"]."'>" . $row["nazwa"] . "</a>";
                echo "</div>";
            }
        } else {
            echo "Brak wypożyczeń";
        }
        echo "</div>";

        mysqli_close($conn);
        ?>
    </body>
</html>
