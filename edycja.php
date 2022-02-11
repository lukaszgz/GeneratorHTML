<?php
session_start();
//Sprawdzamy czy uzytkownik jest zalogowany, jeśli nie to odsyłamy go na strone logowania
if(!isset($_SESSION['signedIn']))
{
    header("location: index.php");
    exit();
}
//Jeśli użytkownik niema swojego folderu na zdjęcia to go tworzymy
if (!is_dir("uploads/" . $_SESSION['folder']))
    mkdir("uploads/" . $_SESSION['folder'], 0777);

//funkcja 
function EmptyDir($dirName, $rmDir = false) {
            if ($dirHandle = opendir($dirName)) {
                while (false !== ($dirFile = readdir($dirHandle)))
                    if ($dirFile != "." && $dirFile != "..")
                        if (!unlink($dirName . "/" . $dirFile))
                            return false;
                closedir($dirHandle);
                if ($rmDir)
                    if (!rmdir($dirName))
                        return false;
                return true;
            } else
                return false;
        }

        if (isset($_GET['start'])) {
            EmptyDir("uploads/" . $_SESSION['folder'], false);
        }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Szablon Allegro</title>
        <link rel="stylesheet" type="text/css" href="szablon.css">
        <link rel="stylesheet" type="text/css" href="gallery.css">
        

    </head>
    <body>
        <script type="text/javascript" src="java.js"></script>
        <script type="text/javascript" src="jquery.min.js"></script>
        

        <div id="editPanel">
            <div id="btn" class="btnBack" >
                E D Y T U J
            </div>
            <div>
                <div id="welcome">
                    <?php
                    echo '<p><a href="logout.php">Wyloguj się</a></p>';
                    echo "<h4>Witaj " . $_SESSION['user'] . "</h4>";                   
                    ?>
                </div>

                <fieldset>
                    <legend>Wczytaj fotki z dysku</legend>

                    <form enctype="multipart/form-data" action="upload.php" method="post">
                        <input type="file" name="fileToUpload[]" id="plik" multiple="">
                        <input id="sendFilesBTN" type="button" value="Wyślij">
                    </form>
                    <section>
                        <h3>Postęp wysyłania</h3>
                        <output id="status">Wybierz plik i naciśnij <i>Wyślij</i>.</output>
                        <progress value="0" max="100" id="postep"></progress>
                    </section>
                </fieldset>

                <label for="titleEdit">Tytuł:<br></label><input type="text" id="titleEdit" name="main" placeholder="Nazwa przedmiotu">
                <label for="telephoneEdit">Telefon:<br></label><input type="tel" id="telephoneEdit" name="main" placeholder="555-555-555">
                <label for="emailEdit">Email:<br></label><input type="email" id="emailEdit" name="main" placeholder="email@mail.com">

                <fieldset>
                    <legend>Specyfikacja:</legend>
                    <ul id="specyficationConteiner" style="list-style-type: none; margin: 0; padding: 0;">
                        <li class="divSpecyficationInput">
                            <input type="text" class="specyficationEdit" name="specyfication">
                            <input type="submit" class="removeSpecyficationBTN" value="-">
                        </li>
                        <li class="divSpecyficationInput">
                            <input type="text" class="specyficationEdit" name="specyfication">
                            <input type="submit" class="removeSpecyficationBTN" value="-">
                        </li>
                        <li class="divSpecyficationInput">
                            <input type="text" class="specyficationEdit" name="specyfication">
                            <input type="submit" class="removeSpecyficationBTN" value="-">
                        </li>
                    </ul>
                    <input type="submit" class="addNewSpecyficationBTN" value="+">
                </fieldset>

                <fieldset>
                    <legend>Zdjęcie główne</legend>
                    <button id="selectMainPhotoBTN" style="width: 100%;">Wybierz zdjęcie z galerii</button><br/>
                    <label for="specyficationPhotoEdit">...lub wprowadź adres obrazka:<br></label><input type="URL" id="specyficationPhotoEdit" name="main" placeholder="URL:">
                </fieldset>

                <fieldset>
                    <legend>Zdjęcie przy opisie</legend>
                    <button id="selectDescPhotoBTN" style="width: 100%;">Wybierz zdjęcie z galerii</button><br/>
                    <label for="descriptionPhotoEdit">...lub wprowadź adres obrazka:<br></label><input type="URL" id="descriptionPhotoEdit" name="main" placeholder="URL:">
                </fieldset>



                <label>Opis przedmiotu</label><br><textarea rows="1" id="descriptionEdit" name="descriptionEdit"></textarea>
                <input type="checkbox" id="chBoxDescriptionPlus" checked><label for="chBoxDescriptionPlus" >Dodatkowy opis</label><br><textarea rows="1" id="descriptionPlusEdit" name="descriptionEdit"></textarea>
                <input type="checkbox" id="chBoxFooter" checked><label for="chBoxFooter" >Stopka strony</label><br><textarea rows="1" id="footerEdit" name="footerEdit"></textarea>

                <fieldset>
                    <legend>Zawartość zestawu:</legend>
                    <ul id="equipmentConteiner" style="list-style-type: none; margin: 0; padding: 0;">
                        <li class="divEquipmentInput">
                            <input type="text" class="equipmentEdit" name="Equipment">
                            <input type="submit" class="removeEquipmentBTN" value="-">
                        </li>
                        <li class="divEquipmentInput">
                            <input type="text" class="equipmentEdit" name="Equipment">
                            <input type="submit" class="removeEquipmentBTN" value="-">
                        </li>
                        <li class="divEquipmentInput">
                            <input type="text" class="equipmentEdit" name="Equipment">
                            <input type="submit" class="removeEquipmentBTN" value="-">
                        </li>
                    </ul>
                    <input type="submit" class="addNewEquipmentBTN" value="+">
                </fieldset>


                <fieldset>
                    <legend>Dostawa</legend>
                    <input type="checkbox" name="supply" checked id="personal"><label for="personal">Odbiór osobisty</label><br>
                    <input type="checkbox" name="supply" checked id="oneday"><label for="oneday">Wysyłka w 24h</label><br>
                    <input type="checkbox" name="supply" checked id="COD"><label for="COD">Wysyłka pobraniowa</label><br>
                    <input type="checkbox" name="supply" checked id="free"><label for="free">Darmowa dostawa</label><br>
                    <input type="checkbox" name="supply" checked id="return"><label for="return">Możliwość zwrotu do 14dni</label><br>
                    <input type="checkbox" name="supply" checked id="risk"><label for="risk">Ubezpieczenie wysyłki</label><br>
                </fieldset>
            </div>

            <button id="galleryBTN" style="width: 100%; margin: 10px 0;">GALERIA - Wybierz zdjęcia</button>
            <input type="submit" id="generateBTN" value="Generuj kod">
        </div>

        <div id="template" style="display: none;">
            <h3>Skopiuj zawartość i wklej do edytora Allegro</h3>
            <textarea id="textarea"></textarea>
            <img src="./img/close.png" height="30" width="30" alt="ZAMKNIJ">
        </div>

        <div id="bigGallery">
            <div id="minPhotos">
                <h2>Wybierz zdjęcia do galerii w swojej aukcji</h2>
                <img class="close" src="img/close.png" height="20" width="20" title="Zamknij Galerię" alt="zamiknij">
                <img class="deleteAllPhotosIcon" src="img/deleteSelected.png" height="20" title="Usuń wszystkie zdjęcia" alt="Usuń wszystkie zdjecia">
                <div class="boxOnPhotos">
                
                </div>
<!--
                <div class="photo">
                    <div class="icons">
                        <img class="icon look" src="img/look.png" alt="lupa" title="Powiększ">
                        <img class="icon delete" src="img/delete.png" alt="usun" title="Usuń">
                    </div>
                    <img class="min" src="photos/DSC00839.jpg" alt="miniaturka" title="Zaznacz">
                </div>
-->
                <div class="footerGallery">
                    <div class="okBtn okBtnDisabled">OK</div>
                </div>

            </div>	

            <div class="bigPhotoLook" style="display: none;">
                <img class="closeBtn" src="img/close_btn.png" alt="zamknij">
                <img class="arrow left" src="img/left.png" alt="w lewo">
                <img class="bigPhoto" src="" alt="zdjęcie w powiększeniu">
                <img class="arrow right" src="img/right.png" alt="w prawo">
            </div>
        </div>

        <div id="contentBox">
            <div id="banner" style="height: 50px;background-image: linear-gradient(#f8f7f3, white);">
                <div id="logo">
                    <img src="./img/koszyk.png" style="height: 120px;width: 120px;margin-left: 40px;margin-top: 20px;">
                </div>
            </div>
            <div id="content" style="margin: 0 auto;width: 1200px;color: #3A3A3A;">

                <div id="menu">
                    <ul style="list-style-type: none;display: flex;justify-content: flex-end;font-size: 20px;font-weight: bold;">
                        <li> <a href="#title" style="text-decoration: none;color: #8d8d8d;padding: 20px;">Opis</a></li>
                        <li><a href="#gallery" style="text-decoration: none;color: #8d8d8d;padding: 20px;">Galeria</a></li>
                        <li><a href="#supply" style="text-decoration: none;color: #8d8d8d;padding: 20px;">Dostawa</a></li>
                        <li><a href="#contact" style="text-decoration: none;color: #8d8d8d;padding: 20px;">Kontakt</a></li>
                    </ul>
                </div>

                <div id="firstHr" class="hr" style="margin-top: 70px;text-align: right;">
                    <img src="./img/tel.jpg" alt="telefon: " height="30" width="30" style="margin-bottom: -5px;"><span style="font-size: 30px;margin-right: 20px;"> 555-555-555</span>
                </div>
                <hr style="margin-bottom: 70px;">

                <div id="title">
                    <h1 style="text-align: center;width: 500px;margin-left: auto;margin-right: auto;padding: 30px 0;color: #8d8d8d;">NAZWA PRZEDMIOTU</h1>
                </div>

                <div id="description">

                    <div class="desc" style="height: 500px;margin: 30px 0;">
                        <div id="specyfication" style="display: table;float: left;width: 500px;height: 440px;padding: 10px;">
                            <ul id="specyficationUl" style="list-style-type: none;font-size: 30px;font-weight: bold;display: table-cell;vertical-align: middle;">
                                <li style="padding: 5px;"> Specyfikacja </li>
                                <li style="padding: 5px;"> Specyfikacja </li>
                                <li style="padding: 5px;"> Specyfikacja </li>
                            </ul>
                        </div>

                        <div class="photoSpecyfication1" style="float: right;padding: 30px;line-height: 400px;">
                            <img src="./img/SmarphoneJPG.jpg" style="max-height: 400px;max-width: 400px;vertical-align: middle;">
                        </div>

                    </div>

                    <div style="clear: both;"></div>

                    <div class="desc" style="height: 500px;margin: 30px 0;">
                        <div class="photoSpecyfication2" style="float: left;padding: 30px;line-height: 400px;">
                            <img src="./img/smartphone.png" style="max-height: 400px;max-width: 400px;vertical-align: middle;">
                        </div>

                        <div id="details_desc" style="float: right;padding: 10px;width: 400px;height: 440px;display: table;">
                            <p style="font-size: 20px;margin: 0;display: table-cell;vertical-align: middle;">Pellentesque nec sem nisi. Vivamus vestibulum, arcu imperdiet auctor elementum, augue ante lacinia nibh, quis pulvinar nisi arcu a ante. Donec ornare viverra ornare. Cras vestibulum velit eu lacinia bibendum. Nunc commodo luctus tellus at efficitur. Curabitur vitae tortor facilisis, vehicula risus ac, lobortis lacus. Sed pellentesque tincidunt felis, porttitor ullamcorper nisl semper at. Nulla molestie quis risus a bibendum. Pellentesque nec sem nisi. Vivamus vestibulum, arcu imperdiet auctor elementum, augue ante lacinia nibh, quis pulvinar nisi arcu a ante. Donec ornare viverra ornare.</p>
                        </div>
                    </div>

                </div>

                <div id="details_desc_plus" style="clear: both;">
                    <p style="font-size: 20px;margin: 0;">
                        Cras vestibulum velit eu lacinia bibendum. Nunc commodo luctus tellus at efficitur. Curabitur vitae tortor facilisis, vehicula risus ac, lobortis lacus. Sed pellentesque tincidunt felis, porttitor ullamcorper nisl semper at. Nulla molestie quis risus a bibendum. Pellentesque nec sem nisi. Vivamus vestibulum, arcu imperdiet auctor elementum, augue ante lacinia nibh, quis pulvinar nisi arcu a ante. Donec ornare viverra ornare. 
                    </p>
                </div>

                <div class="desc" style="height: 500px;margin: 30px 0;">
                    <div class="hr" style="margin-top: 70px;">
                        <img src="./img/zestaw.png" alt="telefon: " height="30" width="30" style="margin-bottom: -5px;"><span style="font-size: 30px;"> W zestawie</span>
                    </div>
                    <hr style="margin-bottom: 70px;">
                    <div id="equipment" style="display: table;float: left;width: 500px;height: 360px;padding: 10px;">
                        <ul id="equipmentList" style="list-style-type: circle;font-size: 30px;font-weight: bold;display: table-cell;vertical-align: middle;">
                            <li style="padding: 5px;"> Element </li>
                            <li style="padding: 5px;"> Element </li>
                            <li style="padding: 5px;"> Element </li>
                        </ul>
                    </div>

                    <div class="photoSpecyfication1" style="float: right;padding: 30px;line-height: 400px;">
                        <img src="./img/bigzestaw.jpg" style="max-height: 400px;max-width: 400px;vertical-align: middle;">
                    </div>

                </div>

                <div id="gallery" style="clear: both;">
                    <div class="hr" style="margin-top: 70px;">
                        <img src="./img/galeria.png" alt="telefon: " height="30" width="30" style="margin-bottom: -5px;"><span style="font-size: 30px;"> Galeria</span>
                    </div>
                    <hr style="margin-bottom: 70px;">
                    <ul style="list-style-type: none;text-align: center;margin: 0;padding: 0;">
                        <li class="photo"><img src="" style="width: 100%;margin: 0;border-radius: 10px;"></li>
                        <li class="photo"><img src="./img/smartphone.png"></li>
                        <li class="photo"><img src="" style="width: 100%;margin: 0;border-radius: 10px;"></li>
                    </ul>
                </div>

                <div class="hr" style="margin-top: 70px;">
                    <img src="./img/dostawa.png" alt="telefon: " height="30" width="30" style="margin-bottom: -5px;"><span style="font-size: 30px;"> Dostawa</span>
                </div>
                <hr style="margin-bottom: 70px;">
                <div id="supply">
                    <ul style="list-style-type: none;text-align: center;padding: 0;">
                        <li class="personal" style="display: inline-block;">
                            <div class="supplyElement" style="background-color: lightgrey;border-radius: 50%;height: 200px;width: 200px;text-align: center;padding: 50px;margin: 10px;font-weight: bold;line-height: 30px;">
                                Odbiór osobisty:
                                <img src="./img/Check_mark.png" style="height: 150px;width: 150px;">
                            </div></li>
                        <li class="oneday" style="display: inline-block;">
                            <div class="supplyElement" style="background-color: lightgrey;border-radius: 50%;height: 200px;width: 200px;text-align: center;padding: 50px;margin: 10px;font-weight: bold;line-height: 30px;">
                                Wysyłka w ciągu:
                                <img src="./img/h24.png" style="height: 150px;width: 150px;">
                            </div></li>
                        <li class="COD" style="display: inline-block;">
                            <div class="supplyElement" style="background-color: lightgrey;border-radius: 50%;height: 200px;width: 200px;text-align: center;padding: 50px;margin: 10px;font-weight: bold;line-height: 30px;">
                                Wysyłka pobraniowa:
                                <img src="./img/Check_mark.png" style="height: 150px;width: 150px;">
                            </div></li>
                        <li class="free" style="display: inline-block;">
                            <div class="supplyElement" style="background-color: lightgrey;border-radius: 50%;height: 200px;width: 200px;text-align: center;padding: 50px;margin: 10px;font-weight: bold;line-height: 30px;">
                                Darmowa dostawa:
                                <img src="./img/Check_mark.png" style="height: 150px;width: 150px;">
                            </div></li>
                        <li class="return" style="display: inline-block;">
                            <div class="supplyElement" style="background-color: lightgrey;border-radius: 50%;height: 200px;width: 200px;text-align: center;padding: 50px;margin: 10px;font-weight: bold;line-height: 30px;">
                                Możliwość zwrotu:
                                <img src="./img/14dni.png" style="height: 150px;width: 150px;">
                            </div></li>
                        <li class="risk" style="display: inline-block;">
                            <div class="supplyElement" style="background-color: lightgrey;border-radius: 50%;height: 200px;width: 200px;text-align: center;padding: 50px;margin: 10px;font-weight: bold;line-height: 30px;">
                                Ubezpieczenie wysyłki:
                                <img src="./img/Check_mark.png" style="height: 150px;width: 150px;">
                            </div>
                        </li>
                    </ul>

                    <div style="clear: both;"></div>

                </div>

                <div id="contactBox">
                    <div class="hr" style="margin-top: 70px;">
                        <img src="./img/kontakt.png" alt="telefon: " height="30" width="30" style="margin-bottom: -5px;"><span style="font-size: 30px;"> Kontakt</span>
                    </div>
                    <hr style="margin-bottom: 70px;">
                    <div style="text-align: center;">
                        <div id="contact2" class="contact" style="background-color: lightgrey;border-radius: 10px;height: 300px;width: 40%;display: inline-block;text-align: center;padding: 40px;margin: 10px;">
                            <h2 style="font-size: 30px;margin-top: 0;margin-bottom: 25px;">555-555-555</h2>
                            <img src="./img/Phone-PNG-Pic.png" height="200" width="200">
                        </div>

                        <div id="email" class="contact" style="background-color: lightgrey;border-radius: 10px;height: 300px;width: 40%;display: inline-block;text-align: center;padding: 40px;margin: 10px;">
                            <h2 style="font-size: 30px;margin-top: 0;margin-bottom: 25px;">zaqwsdsadsasx@gmail.com</h2>
                            <img src="./img/Logo_email.png" height="200" width="200">
                        </div>
                    </div>
                    <div id="contact" style="clear: both;">
                        <p style="font-size: 20px;margin: 0;text-align: center;padding: 20px;">
                            Zapraszam do kontaktu, chętnie udzielę dodatkowych informacji oraz rozwieję wszelkie wątpliwości :)
                        </p>
                    </div>

                    <div id="goTop" style="position: absolute;bottom: 20px;right: 20px;">
                        <a href="#">
                            <img src="./img/go_top.png" height="50" width="50" title="Przewiń do początku strony">
                        </a>
                    </div>
                </div>
            </div>
        
        </div>

        <div id="cloud" hidden></div>
        
       
    </body>
</html>