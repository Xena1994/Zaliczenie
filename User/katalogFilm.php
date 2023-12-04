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
        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="CSS/katalogFilmCSS.css">
          <script>
            $(document).ready(function(){
                /* $('button').each(function(){ //sprawdzam czy już wypozyczony
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
                }); */
        
                $(document).on("click", '.submitLong', function(){
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
                
                $(document).on("click", '.submitLong-szukaj', function(){
                    $nameValue = $('#nazwaInput').val();
                    $categoryValue = $('#kategoria').val();
                    $('#lightbox').load("szukajFilm.php", {idUser: $(this).data("iduser"), nazwa: $nameValue, kategoria: $categoryValue});
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
        $kategorie;

   
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        echo "<div class='topnav'>";
        echo    "<a href='wypozyczenia.php?idUser=".$_GET["idUser"]."'> Wypożyczenia </a>";        
        echo    "<a href='katalogFilm.php?idUser=".$_GET["idUser"]."'> Filmy </a>";
        echo    "<a href='wyswietlInformacje.php?idUser=".$_GET["idUser"]."'> Użytkownik </a>";
        echo    "<a href='../index.php'> Wyloguj </a>";
        echo    "<div id='inputs'>"; 
        echo        "<i class='fa fa-film' style='font-size:24px; color:#ccc;'></i>";
        echo        "<input id='nazwaInput' type='text' name='name' placeholder='Nazwa filmu' required><br>";
        echo    "</div>";
        echo    "<div id='inputs'>"; 
        echo        "<i class='fa fa-film' style='font-size:24px; color:#ccc;'></i>";
        echo        "<select id='kategoria'>";
        echo        "<option selected disabled>Kategorie filmów</option>";
        
        
        $sql = "SELECT * FROM kategoriefilm";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row["id"]."'>".$row["nazwa"]."</option>";
            }
        }
        echo        "<option value='ALL'> Wszystkie </option>";
        echo    "</select><br>";
        echo    "</div>";
        echo    "<button class='submitLong-szukaj' data-iduser='".$_GET["idUser"]."' style='display: inline-block; width: 10%;'> Szukaj </button>";
        echo "</div>";
                
        echo "<div id='lightbox'>";
        $sql = "SELECT * FROM film";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div id='plakat'>";
                echo    "<a href='Film.php?id=".$row["id"]."&idUser=".$_GET["idUser"]."'><img src='../Plakaty/" . $row["plakat"] . "' width='200px' height='300px'></a><br>";
                echo    "<a href='Film.php?id=".$row["id"]."&idUser=".$_GET["idUser"]."'>" . $row["nazwa"] . "</a><br>";

                $selectCount = "SELECT id FROM wypozyczenie WHERE idFilmu='".$row["id"]."' AND idUzytkownik='".$_GET["idUser"]."'";
                $resultSelect = $conn->query($selectCount);
                if($resultSelect->num_rows > 0) { 
                    echo "<p> Wypożyczono </p>";    
                } else { 
                    echo "<button class='submitLong' data-idfilm='".$row["id"]."' data-iduser='".$_GET["idUser"]."' data-cenafilm='".$row["cenaWypozyczenia"]."'> Wypożycz film </button>";
                }
                
                echo "</div>";
            }
        }
        echo "</div>";
        
        mysqli_close($conn);
        ?>
    </body>
</html>
