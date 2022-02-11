<?php
session_start();

if(isset($_SESSION['signedIn']) && ($_SESSION['signedIn'] == true))
{
    header("location: edycja.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Szablon Allegro - Zarejestruj się</title>
        <link rel="stylesheet" type="text/css" href="logowanie.css">

    </head>
    <body>
        <div id="header">
            <h1>GENERATOR AUKCJI ALLEGRO</h1>
            <h3>Zarejestruj się lub <a href="./index.php">Zaloguj</a></h3>
        </div>

        <div id="registerBox">
            <form method="post" action="rej.php">
                <input type="text" name="name" placeholder = "IMIE" required="" />
                <input type="text" name="surname" placeholder = "NAZWISKO" />
                <input type="text" name="login" placeholder = "LOGIN" required=""/>
                <input type="text" name="email" placeholder = "E-MAIL" required=""/>
                <input type="password" name="password" placeholder = "HASŁO" required=""/>
                <input type="password" name="password2" placeholder = "POWTÓRZ HASŁO" required=""/>
                <input type="submit" value="REJESTRUJ" name="registerBTN" required=""/>
            </form>  
            <?php
            if(isset($_SESSION['blad']))
            {
                echo $_SESSION["blad"];
                unset($_SESSION['blad']);
            }
            ?>
            
        </div>
        <video id="bg" autoplay="autoplay" loop="loop">
            <source src="http://www.giez.pl/background.mp4" type="video/mp4" />
        </video>
    </body>
</html>