<?php
session_start();
//print_r($_FILES);


for ($i = 0; $i < count($_FILES["fileToUpload"]["name"]); $i++) {
    $target_dir = "uploads/".$_SESSION['folder']."/";

    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $fileName = (string) $_FILES["fileToUpload"]["tmp_name"][$i];
        $check = getimagesize($fileName);
        if ($check !== false) {
            //echo "</br>Plik jest obrazkiem - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "</br>Plik " . basename($_FILES["fileToUpload"]["name"][$i]) . "</br>Plik nie jest obrazkiem.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "</br>Plik " . basename($_FILES["fileToUpload"]["name"][$i]) . " o tej nazwie już istnieje.";
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["fileToUpload"]["size"][$i] > 10000000) {
        echo "</br>Plik " . basename($_FILES["fileToUpload"]["name"][$i]) . "</br>Plik jest zbyt duży.";
        $uploadOk = 0;
    }
    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "JPG" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Twoj plik: ".$imageFileType . "<br>";
        echo "</br>Możesz wgrać tylko pliki: JPG, JPEG, PNG i GIF.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo " Plik nie został wgrany na serwer!";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
            echo "</br>Plik " . basename($_FILES["fileToUpload"]["name"][$i]) . " został załadowany pomyślnie.";
        } else {
            echo "</br>Błąd wgrywania pliku!";
        }
    }
   
}


//echo "<br/><a href=\"edycja.php\">POWRÓT</a>";
?>