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
        <link rel="stylesheet" type="text/css" href="CSS/daneFilmowAdminCSS.css">
                  <script>
            $(document).ready(function(){
                
                $(document).on("click", '.submitLong-szukaj', function(){
                    $nameValue = $('#nazwaInput').val();
                    $categoryValue = $('#kategoria').val();
                    $('#lightbox').load("szukajFilmAdmin.php", {nazwa: $nameValue, kategoria: $categoryValue});
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
        echo    "<button id='submitLong' class='submitLong-szukaj' style=' display: inline-block; width: 10%; position: static;' > Szukaj </button>";
        echo "</div>";
        
        echo "<div id='lightbox'>";
        echo    "<a href='dodawanieFilmForm.php' style='text-align: left; display: block; text-decoration: underline;'> Dodaj film </a><br>";
        $sql = "SELECT * FROM film";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<div id='plakat'>";
                echo    "<a href='FilmAdmin.php?id=".$row["id"]."'><img src='../Plakaty/".$row["plakat"]."' width='200px' height='300px'></a><br>";
                echo    "<a href='FilmAdmin.php?id=".$row["id"]."'>".$row["nazwa"]."</a><br>";
                echo    "<a id='submitLong' href='usunFilm.php?id=".$row["id"]."'> Usuń film </a>";
                echo "</div>";
            }
        }
        
        echo "</div>";
        mysqli_close($conn);
        ?>
    </body>
</html>
