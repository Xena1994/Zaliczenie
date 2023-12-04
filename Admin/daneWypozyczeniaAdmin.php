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
        <link rel="stylesheet" type="text/css" href="CSS/daneWypozyczeniaAdminCSS.css">
    </head>
    <body>
        <div class="topnav">
            <a href="daneFilmowAdmin.php"> Filmy </a>
            <a href="daneUzytkownicyAdmin.php"> Użytkownicy </a>
            <a href="daneKategorieAdmin.php"> Kategorie </a>
            <a href="daneWypozyczeniaAdmin.php"> Wypożyczenia </a>
            <a href="../index.php"> Wyloguj </a>
        </div>
        
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bazazaliczenie";
        $kategorie;

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        echo "<table id='lightbox'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th> Nazwa filmu </th>";
        echo "<th> Nazwa użytkownika </th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        $sql = "SELECT w.id, f.nazwa AS nazwaFilm, u.nazwa AS nazwaUzytkownik FROM wypozyczenie w, film f, uzytkownik u WHERE w.idUzytkownik = u.id AND w.idFilmu = f.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nazwaFilm"] . "</td>";
                echo "<td>" . $row["nazwaUzytkownik"] . "</td>";
                echo "<td id='submitLong'><a href='usunWypozyczenie.php?id=".$row["id"]."'> Usuń wypożyczenie </a></td>";
                echo "</tr>";
            }
        }
        echo "</tbody>";
        echo "</table>";
        
        mysqli_close($conn);
        ?>
    </body>
</html>
