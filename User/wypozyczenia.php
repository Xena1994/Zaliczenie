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
        <link rel="stylesheet" type="text/css" href="CSS/wypozyczeniaCSS.css">
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
        

        echo "<div id='lightbox'>";

        $sql = "SELECT f.id, f.plakat, f.nazwa FROM film f, wypozyczenie w WHERE w.idUzytkownik='".$_GET["idUser"]."' AND w.idFilmu = f.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div id='plakat'>";
                echo    "<a href='Film.php?id=".$row["id"]."&idUser=".$_GET["idUser"]."'><img src='../Plakaty/" . $row["plakat"] . "' width='200px' height='300px'></a><br>";
                echo    "<a href='Film.php?id=".$row["id"]."&idUser=".$_GET["idUser"]."'>" . $row["nazwa"] . "</a>";
                echo    "<form action='zwrocFilm.php' method='post'>";
                echo        "<input type='hidden' name='idFilm' value='" . $row["id"] . "'>";
                echo        "<input type='hidden' name='idUzytkownik' value='" . $_GET["idUser"] . "'>";
                echo        "<input id='submitLong' type='submit' value='Zwróć film'>";
                echo    "</form>";
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
