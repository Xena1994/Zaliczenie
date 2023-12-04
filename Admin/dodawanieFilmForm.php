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
        <link rel="stylesheet" type="text/css" href="CSS/dodawanieFilmFormCSS.css">
    </head>
    <body>
        <div class="topnav">
            <a href="daneFilmowAdmin.php"> Filmy </a>
            <a href="daneUzytkownicyAdmin.php"> Użytkownicy </a>
            <a href="daneKategorieAdmin.php"> Kategorie </a>
            <a href="daneWypozyczeniaAdmin.php"> Wypożyczenia </a>
            <a href="../index.php"> Wyloguj </a>
        </div>
        
        <div id="lightbox">
        <form action="dodawanieFilm.php" method="post" enctype="multipart/form-data"> 
            <div id="inputs">
                <i class="fa fa-film" style="font-size:24px; color:#ccc;"></i>
                <input type="text" name="nazwa" placeholder="Nazwa filmu" required>
            </div>
            
            <textarea rows="4" cols="50" name="opis" required> Opis filmu </textarea>
            <div id="inputs">
                <i class="fa fa-film" style="font-size:24px; color:#ccc;"></i>
                <input type="text" name="rezyser" placeholder="Reżyser" required>
            </div>    
            
            <div id="inputs">
                <i class="fa fa-film" style="font-size:24px; color:#ccc;"></i>
                <input type="text" name="scenariusz" placeholder="Scenariusz" required>
            </div>    
            
            <div id="inputs">
                <i class="fa fa-film" style="font-size:24px; color:#ccc;"></i>
                <input type="text" name="dataPremiery" placeholder="Data premiery (format YYYY-MM-DD): " required><br>
            </div>
            
            <div id="inputs">
                Plakat:
                <input type="file" name="fileToUpload" id="fileToUpload"><br>
            </div>
                   
            <div id="inputs">
                <i class="fa fa-film" style="font-size:24px; color:#ccc;"></i>
                <input type="number" name="cena" placeholder="Cena" required><br>
            </div>
            
            <div id="inputs">
                <i class="fa fa-film" style="font-size:24px; color:#ccc;"></i>
                <select name="kat" required>
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

                $sql = "SELECT id, nazwa FROM kategoriefilm";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value=".$row["id"].">".$row["nazwa"]."</option>";
                    }
                }

                mysqli_close($conn);
                ?>
                </select>
            </div>
            <input id="submitLong" type="submit" value="Wyślij">
        </form>
        </div>
    </body>
</html>
