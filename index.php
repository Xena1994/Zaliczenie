<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="indexCSS.css">
    </head>
    <body>
        <div id="wrapper">
            <h1 id="header"> Wypożyczalnia filmów </h1>
            <p id="headerThree"> Logowanie </p>
            <div id="lightboxThree">
                <form action="zalogujUzytkownik.php" method="post">
                    <div id="inputs"> 
                        <i class="fa fa-user" style="font-size:24px; color:#ccc;"></i>
                        <input type="text" name="name" placeholder="Nazwa użytkownika" required><br>
                    </div>

                    <div id="inputs"> 
                        <i class="fa fa-lock" style="font-size:24px; color:#ccc;"></i>
                        <input type="text" name="password" placeholder="Hasło" required><br>
                    </div>
                    <input type="submit" id="submitLong" value="Zaloguj">
                </form>
            </div>

            <p id="headerFour"> Rejestracja </p>
            <div id="lightboxFour">
                <form action="zarejestrujUzytkownik.php" method="post">
                    <div id="inputs"> 
                        <i class="fa fa-user" style="font-size:24px; color:#ccc;"></i>
                        <input type="text" name="name" placeholder="Nazwa użytkownika" required><br>
                    </div>

                    <div id="inputs"> 
                        <i class="fa fa-lock" style="font-size:24px; color:#ccc;"></i>
                        <input type="text" name="password" placeholder="Hasło" required><br>
                    </div>

                    <div id="inputs"> 
                        <i class="fa fa-lock" style="font-size:24px; color:#ccc;"></i>
                        <input type="text" name="passwordConfirm" placeholder="Potwierdź hasło" required><br>
                    </div>

                    <div id="inputs"> 
                        <i class="fa fa-envelope" style="font-size:24px; color:#ccc;"></i>
                        <input type="text" name="email" placeholder="Email" required><br>
                    </div>
                    <input type="submit" id="submitLong" value="Zarejestruj">
                </form>
            </div>
        </div>
    </body>
</html>