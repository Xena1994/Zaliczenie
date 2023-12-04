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
        <link rel="stylesheet" type="text/css" href="CSS/edycjaFilmFormCSS.css">
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
        echo "<div id = 'lightbox'>";
        echo "<form action='edycjaFilm.php' method='post'>"; 
        
        echo "<input type='hidden' name='id' value='".$_POST["id"]."'>";
        
        echo "<div id = 'inputs'>";
        echo    "<i class = 'fa fa-film' style = 'font-size:24px; color:#ccc;'></i>";
        echo    "<input type = 'text' name = 'nazwa' placeholder = 'Tytuł: ".$_POST["tytul"]."' required>";
        echo "</div>";
        
        echo "<textarea rows='6' cols='50' name='opis' required>Opis: ".$_POST["opis"]."</textarea>";
        
        echo "<div id = 'inputs'>";
        echo    "<i class = 'fa fa-film' style = 'font-size:24px; color:#ccc;'></i>";
        echo    "<input type='text' name='rezyser' placeholder='Reżyser: ".$_POST["rezyseria"]."' required>";
        echo "</div>";
               
        echo "<div id = 'inputs'>";
        echo    "<i class = 'fa fa-film' style = 'font-size:24px; color:#ccc;'></i>";
        echo    "<input type='text' name='scenariusz' placeholder='Scenariusz: ".$_POST["scenariusz"]."' required>";
        echo "</div>";
        
        echo "<div id = 'inputs'>";
        echo    "<i class = 'fa fa-film' style = 'font-size:24px; color:#ccc;'></i>";
        echo    "<input type='text' name='dataPremiery' placeholder='Data premiery: ".$_POST["dataPremiery"]."' required>";
        echo "</div>";
        
        echo "<div id = 'inputs'>";
        echo    "<i class = 'fa fa-film' style = 'font-size:24px; color:#ccc;'></i>";
        echo    "<input type='number' name='cena' placeholder='Cena wypożyczenia: ".$_POST["cena"]."' required>";
        echo "</div>";
        
        echo "<div id = 'inputs'>";
        echo    "<i class = 'fa fa-film' style = 'font-size:24px; color:#ccc;'></i>";
        echo    "<select name='kat' required>";
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

            $sql = "SELECT id, nazwa FROM kategoriefilm";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value=" . $row["id"] . ">" . $row["nazwa"] . "</option>";
                }
            }

            mysqli_close($conn);
        echo "</select>";
        echo "</div>";
        echo "<input id='submitLong' type='submit' value='Wyślij'>";
        echo "</form>";
        echo "</div>";
        ?>
        
    </body>
</html>