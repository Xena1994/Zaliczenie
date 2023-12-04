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
        <link rel="stylesheet" type="text/css" href="CSS/FilmCSS.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
        <script>
            $(document).ready(function() {
                
                $('#submitLong-rentMovie').each(function(){ //sprawdzam czy już wypozyczony
                    var thisButton = this;
                    $.ajax({
                        type: "POST",
                        url: "czyWypozyczony.php",
                        data: { idFilm: $(this).data("idfilm"), idUser: $(this).data("iduser") },
                        success: function(e){
                            if(e == "TRUE") {
                                //alert(this) - wskazuje TYLKO na obiekt, nie na obiekt HTML dlaczego
                                //alert(e);
                                $(thisButton).prop("disabled", true);
                                $("span", thisButton).text("Wypożyczono");

                            }
                        }
                    });
                });
                
                $('#submitLong-addFavorite').each(function(){ //sprawdzam czy już w ulubionych
                    var thisButton = this;
                    $.ajax({
                        type: "POST",
                        url: "czyUlubiony.php",
                        data: { idFilm: $(this).data("idfilm"), idUser: $(this).data("iduser") },
                        success: function(e){
                            if(e == "TRUE") {
                                $("i").css("display", "inline");
                                $("#submitLong-deleteFavorite").css("display", "inline-block");
                            } else { 
                                $(thisButton).css("display", "inline");
                            }
                        }
                    });
                });
                
                $('#submitLong-rentMovie').click(function(){
                    $.ajax({
                        type:"POST",
                        url: "wypozyczFilm.php",
                        data: { idFilm: $(this).data("idfilm"), idUser: $(this).data("iduser"), cenaFilm: $(this).data("cenafilm")},
                        success: function(e){
                            alert(e);
                            location.reload();
                        }
                    });
                });
                
                $('#submitLong-addFavorite').click(function () {
                    $.ajax({
                        type:"POST",
                        url: "dodajUlubione.php",
                        data: { idFilm: $(this).data("idfilm"), idUser: $(this).data("iduser")},
                        success: function(e) {
                            alert(e);
                            location.reload();
                        }
                    });
                });
                
                $('#submitLong-deleteFavorite').click(function () {
                    $.ajax({
                        type:"POST",
                        url: "usunUlubione.php",
                        data: { idFilm: $(this).data("idfilm"), idUser: $(this).data("iduser")},
                        success: function(e) {
                            alert(e);
                            location.reload();
                        }
                    });
                });
                
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
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "bazazaliczenie";

        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT AVG(ocena) AS sredniaOcen FROM ocena WHERE idFilm='".$_GET["id"]."'";
        $result = $conn->query($sql);
        $srednia;
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $srednia = $row["sredniaOcen"];
            }
        }
        
        echo "<div class='topnav'>";
        echo    "<a href='wypozyczenia.php?idUser=".$_GET["idUser"]."'> Wypożyczenia </a>";        
        echo    "<a href='katalogFilm.php?idUser=".$_GET["idUser"]."'> Filmy </a>";
        echo    "<a href='wyswietlInformacje.php?idUser=".$_GET["idUser"]."'> Użytkownik </a>";
        echo    "<a href='../index.php'> Wyloguj </a>";
        echo "</div>";
        
        $sql = "SELECT f.nazwa, f.opis, f.rezyseria, f.scenariusz, f.dataPremiery, f.cenaWypozyczenia, k.nazwa AS gatunek FROM film f, kategoriefilm k WHERE f.id='" . $_GET["id"] . "' AND k.id = f.idKategoriaFilmu";
        $result = $conn->query($sql);
        
        echo "<div id='lightbox'>";
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<p> Tytuł: " . $row["nazwa"] . "</p>";
                echo "<i class='fa fa-star' style='font-size:24px; color:#ccc; display:none;'></i>";
                echo "<p> Gatunek filmu: ". $row["gatunek"]. "</p>";
                echo "<p> Opis: " . $row["opis"] . "</p>";
                echo "<p> Reżyser: " . $row["rezyseria"] . "</p>";
                echo "<p> Scenariusz: " . $row["scenariusz"] . "</p>";
                echo "<p> Data premiery: " . $row["dataPremiery"] . "</p>";
                echo "<p> Cena wypożyczenia: " . $row["cenaWypozyczenia"] . "</p>";
                echo "<p> Średnia ocen: $srednia </p>";
                echo "<button id='submitLong-deleteFavorite' data-idfilm='".$_GET["id"]."' data-iduser='".$_GET["idUser"]."'> Usuń z ulubionych </button><br>";
                echo "<button id='submitLong-addFavorite' data-idfilm='".$_GET["id"]."' data-iduser='".$_GET["idUser"]."'> Dodaj do ulubionych </button><br>";
                
                $selectCount = "SELECT id FROM wypozyczenie WHERE idFilmu='".$_GET["id"]."' AND idUzytkownik='".$_GET["idUser"]."'";
                $resultSelect = $conn->query($selectCount);
                if($resultSelect->num_rows > 0) { 
                    echo "<p> Wypożyczono </p>";    
                } else { 
                    echo "<button id='submitLong-rentMovie' data-idfilm='".$_GET["id"]."' data-iduser='".$_GET["idUser"]."' data-cenafilm='".$row["cenaWypozyczenia"]."'> Wypożycz film </button>";
                }
            }
        }
        echo "</div>";
        
        echo "<div id='headerTwo'> Dodaj ocenę </div>";
        echo "<div id='lightboxTwo'>";
        echo    "<form action='ocenFilm.php' method='post'>";
        echo        "<input type='hidden' name='idFilm' value='".$_GET["id"]."'>";
        echo        "<input type='hidden' name='idUzytkownik' value='".$_GET["idUser"]."'>";
        echo        "<div id='inputs'>";
        echo          "Ocena: <select name='ocena'>";
        echo            "<option value='1'>1</option>";
        echo            "<option value='2'>2</option>";
        echo            "<option value='3'>3</option>";
        echo            "<option value='4'>4</option>";
        echo            "<option value='5'>5</option>";
        echo            "<option value='6'>6</option>";
        echo            "<option value='7'>7</option>";
        echo            "<option value='8'>8</option>";
        echo            "<option value='9'>9</option>";
        echo            "<option value='10'>10</option>";
        echo        "</select><br>";
        echo        "</div>";
        echo        "<input id='submitLong' type='submit' value='Oceń'></td>";
        echo    "</form>";
        echo "</div>";

        echo "<div id='lightboxThree'>";

        $sql = "SELECT * FROM zdjecia WHERE idFilm='" . $_GET["id"] . "'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div class='gallery'>";
                echo    "<img id='myImg' src='../Galeria/" . $row["zdjecie"] . "'>";
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
    </body>
</html>
