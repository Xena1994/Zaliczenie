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
        <link rel="stylesheet" type="text/css" href="CSS/FilmAdminCSS.css">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function(){
                $('img').click(function () {
                    var img = document.getElementById('myImg');
                    var modal = document.getElementById('myModal');
                    var modalImg = document.getElementById("img01");
                    var span = document.getElementsByClassName("close")[0];
                    modal.style.display = "block";
                    modalImg.src = this.src;

                    $(span).click(function () {
                        modal.style.display = "none";
                    });
                });
            });

        </script>
    </head>
    <body>
        <div class="topnav">
            <a href="daneFilmowAdmin.php"> Filmy </a>
            <a href="daneUzytkownicyAdmin.php"> Użytkownicy </a>
            <a href="daneKategorieAdmin.php"> Kategorie </a>
            <a href="daneWypozyczeniaAdmin.php"> Wypożyczenia </a>
            <a href="../index.php"> Wyloguj </a>
        </div>
        <div id="wrapper">
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
            
            $sql = "SELECT f.id, f.nazwa, f.opis, f.rezyseria, f.scenariusz, f.dataPremiery, f.cenaWypozyczenia, k.nazwa AS gatunek FROM film f, kategoriefilm k WHERE f.id='" . $_GET["id"] . "' AND k.id = f.idKategoriaFilmu";
            $result = $conn->query($sql);
                       
            echo "<div id='lightbox'>";
            if ($result->num_rows > 0) {
            // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<p> Tytuł: ".$row["nazwa"]."</p>";
                    echo "<p> Gatunek filmu: ". $row["gatunek"]. "</p>";
                    echo "<p> Opis: ".$row["opis"]."</p>";
                    echo "<p> Reżyser: " .$row["rezyseria"]. "</p>";
                    echo "<p> Scenariusz: " .$row["scenariusz"]. "</p>";
                    echo "<p> Data premiery: " .$row["dataPremiery"]. "</p>";
                    echo "<p> Cena wypożyczenia: " .$row["cenaWypozyczenia"]. "</p>";
                    echo "<form action='edycjaFilmForm.php' method='post'>";
                    echo    "<input type='hidden' name='id' value='".$row["id"]."'>";
                    echo    "<input type='hidden' name='tytul' value='".$row["nazwa"]."'>";
                    echo    "<input type='hidden' name='opis' value='".$row["opis"]."'>";
                    echo    "<input type='hidden' name='rezyseria' value='".$row["rezyseria"]."'>";
                    echo    "<input type='hidden' name='scenariusz' value='".$row["scenariusz"]."'>";
                    echo    "<input type='hidden' name='dataPremiery' value='".$row["dataPremiery"]."'>";
                    echo    "<input type='hidden' name='cena' value='".$row["cenaWypozyczenia"]."'>";
                    echo    "<input id='submitLong' type='submit' value='Edytuj informacje o filmie'>";
                    echo "</form>";
                    echo "<form action='dodajZdjecie.php?id=".$row["id"]."' method='post' enctype='multipart/form-data'>";
                    echo    "<div id='inputs'>";
                    echo        "Zdjecie: ";
                    echo        "<input type='file' name='fileToUpload'>";
                    echo    "</div>";
                    echo    "<input id='submitLong' type='submit' value='Prześlij zdjęcie do galerii'>";
                    echo "</form>";
                }
            }
            echo "</div>";
            
            echo "<div id='lightboxThree'>";

            $sql = "SELECT * FROM zdjecia WHERE idFilm='".$_GET["id"]."'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='gallery'>";
                    echo    "<img id='myImg' src='../Galeria/".$row["zdjecie"]."'>";
                    echo "</div>";
                }
            } else { 
                echo "Brak zdjęć";
            }
            echo "</div>";
            
            echo "<div id='myModal' class='modal'>";
            echo    "<span class='close'>&times;</span>";
            echo    "<img class='modal-content' id='img01'>";
            echo "</div>";

            mysqli_close($conn);
        ?>
        </div>
    </body>
</html>
