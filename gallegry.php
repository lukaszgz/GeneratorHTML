<?php

session_start();

if ($handle = opendir('uploads/' . $_SESSION['folder'])) {
                    $i = 0;
                    /* This is the correct way to loop over the directory. */
                    while (false !== ($entry = readdir($handle))) {
                        if ($entry != '.' && $entry != '..') {
                            //echo '<div class="minPhoto" style="background: "";"><img class="imgMinPhoto" src="uploads/' . $_SESSION['folder'] . '/' . $entry . '"alt="miniaturka"><span>' . $entry . '</span></div>';
                            echo '<div class="photo"><div class="icons"><img class="icon look" src="img/look.png" alt="lupa" title="Powiększ"><img class="icon delete" src="img/delete.png" alt="usun" title="Usuń"></div><img class="min" src="uploads/' . $_SESSION['folder'] . '/' . $entry . '" alt="miniaturka" title="Zaznacz"></div>';
                            $i++;
                        }
                    }
                    if ($i == 0)
                        echo '<strong class = "error">BRAK OBRAZÓW W GALERII - WCZYTAJ ZDJĘCIA Z DYSKU!</strong>';
                    /* This is the WRONG way to loop over the directory. */
                    while ($entry = readdir($handle)) {
                        echo "$entry\n";
                    }

                    closedir($handle);
                }
                

?>