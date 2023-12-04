<?php

if($_POST["password"] != $_POST["passwordConfirm"]) { 
    echo '<script language="javascript">';
    echo 'alert("Podałeś niepoprawne hasło!")
          window.location.href="index.php";';
    echo '</script>';
} else { 
    
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
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    
    $sql = "SELECT * FROM uzytkownik WHERE (nazwa='$name' AND haslo='$password' AND email='$email')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<script language="javascript">';
        echo 'alert("Podałeś już istniejące dane!")
              window.location.href="index.php";';
        echo '</script>';
    } else { 
        $sql = "INSERT INTO uzytkownik (nazwa, haslo, email)
        VALUES ('$name', '$password', '$email')";

        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();

        echo '<script language="javascript">';
        echo 'alert("Zarejestrowano użytkownika!")
              window.location.href="index.php";';
        echo '</script>';
    }
}
?>
