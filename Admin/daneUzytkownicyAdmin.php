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
        <link rel="stylesheet" type="text/css" href="CSS/daneUzytkownicyAdminCSS.css">
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
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        echo "<table id='lightbox'>";
        echo "<thead>";
        echo "<tr>";
        echo "<th> Nazwa użytkownika </th>";
        echo "<th> Hasło </th>";
        echo "<th> Email </th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";

        $sql = "SELECT * FROM uzytkownik";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["nazwa"] . "</td>";
                echo "<td>" . $row["haslo"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td id='submitLong'><a href='usunUzytkownika.php?id=".$row["id"]."'> Usuń użytkownika </a></td>";
                echo "</tr>";
            }
        }
        echo "</tbody>";
        echo "</table>";
        mysqli_close($conn);
        ?>
    </body>
</html>
