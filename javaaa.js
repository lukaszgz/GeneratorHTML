
window.addEventListener('load', function () 
{
    // var template = {
    //     "content":document.getElementById("contentBox")
    // };
    
    // template.content.innerHTML="<h1>Brak szablonu!</h1>";

    document.getElementById("sendFilesBTN").addEventListener('click', wyslijPlik);
    

    var specyficationPhotoEdit = document.querySelector('#specyficationPhotoEdit');
    var descriptionPhotoEdit = document.querySelector('#descriptionPhotoEdit');

    //Wysówane boczne menu edycji szablonu
    var btn = document.getElementById("btn");
    btn.style.left = "340px";
    btn.addEventListener('click', edit, false);

    function edit()
    {
        var ep = document.getElementById("editPanel");
        if (btn.style.left == "340px")
        {
            btn.className = "btn";
            ep.style.left = "-340px";
            btn.style.left = "0";
        } else
        {
            btn.className = "btnBack";
            ep.style.left = "0";
            btn.style.left = "340px";
        }

    }
    

    //Edycja Tutułu
    var inputTitle = document.getElementById("titleEdit");

    inputTitle.addEventListener('focus', function () {
        var t = document.querySelector("h1");
        inputTitle.style.background = "";
        t.style.border = "5px solid yellow";
        t.scrollIntoView();
    }, false);

    inputTitle.addEventListener('blur', function () {
        var t = document.querySelector("h1");
        t.style.border = "";


        if (inputTitle.value == "")
        {
            inputTitle.placeholder = "Uzupełnij Tytuł...";
        } else
        {
            t.textContent = inputTitle.value;
        }
    }, false);

    //Edycja numeru telefonu
    var inputTelephone = document.querySelector('#telephoneEdit');

    inputTelephone.addEventListener('focus', function () {
        var t = document.querySelector("#firstHr span");
        inputTelephone.style.background = "";
        t.style.border = "5px solid yellow";
        t.scrollIntoView();
    }, false);

    inputTelephone.addEventListener('blur', function () {
        var t = document.querySelector("#firstHr span");
        t.style.border = "";


        if (inputTelephone.value == "")
        {
            inputTelephone.placeholder = "Podaj swój numer tel...";
        } else
        {
            t.textContent = inputTelephone.value;
            document.querySelector("#contact2 h2").textContent = t.textContent;
        }
    }, false);

    //Edycja email
    var inputEmail = document.querySelector('#emailEdit');

    inputEmail.addEventListener('focus', function () {
        var t = document.querySelector("#email h2");
        inputEmail.style.background = "";
        t.style.border = "5px solid yellow";
        t.scrollIntoView();
    }, false);

    inputEmail.addEventListener('blur', function () {
        var t = document.querySelector("#email h2");
        t.style.border = "";


        if (inputEmail.value == "")
        {
            inputEmail.placeholder = "Podaj swój email...";
        } else
        {
            t.textContent = inputEmail.value;
        }
    }, false);

    //Edycja specyfikacji

    function addEventForInputs()
    {
        var specyficationEdit = document.querySelectorAll(".specyficationEdit");

        function focus()
        {
            var specyficationEdit = document.querySelectorAll(".specyficationEdit");
            var i = getIndex(this, specyficationEdit);

            var t = document.querySelectorAll("#specyficationUl > li");

            t[i].style.border = "5px solid yellow";
            t[0].scrollIntoView();
        }

        function blur()
        {
            var specyficationEdit = document.querySelectorAll(".specyficationEdit");
            var i = getIndex(this, specyficationEdit);

            var t = document.querySelectorAll("#specyficationUl > li");

            if (this.value == "")
            {
                this.placeholder = "Podaj specyfikację";
            } else
            {
                t[i].textContent = this.value;
            }

            t[i].style.border = "";
        }

        for (var i = 0; i < specyficationEdit.length; i++)
        {
            specyficationEdit[i].addEventListener('focus', focus);
            specyficationEdit[i].addEventListener('blur', blur);
        }
    }

    addEventForInputs();

    //Usuwanie specyfikacji z edycji

    function removeEl()
    {
        var parentBTN = this.parentNode;
        var parentLi = parentBTN.parentNode;
        if (parentLi.childElementCount > 1)
        {

            var t = document.querySelectorAll("#specyficationUl > li");
            var parentT = t[0].parentNode;
            var i = getIndex(parentBTN, parentLi.querySelectorAll("li"));
            parentLi.removeChild(parentBTN);
            parentT.removeChild(t[i]);

            addEventForInputs();
        }
    }

    function removeSpecyficationEvent()
    {
        var removeSpecyficationBTN = document.querySelectorAll('li > .removeSpecyficationBTN');
        for (var i = 0; i < removeSpecyficationBTN.length; i++)
        {
            removeSpecyficationBTN[i].addEventListener('click', removeEl);
        }
    }

    removeSpecyficationEvent();

    //Dodawanie nowej specyfikacji do edycji

    function addSpecyficationEl(e)
    {
        if (document.querySelectorAll("#specyficationConteiner li").length >= 10)
        {
            showCloud(e, "Można dodać max 10 specyfikacji!");
        } else
        {
            var sc = document.getElementById('specyficationConteiner');
            var su = document.getElementById("specyficationUl");
            sc.appendChild(sc.lastElementChild.cloneNode(true));
            su.appendChild(su.lastElementChild.cloneNode(true));

            removeSpecyficationEvent();
            addEventForInputs();
        }

    }

    var newSpecyficationBTN = document.querySelector('.addNewSpecyficationBTN');
    newSpecyficationBTN.addEventListener('click', function (e) {
        addSpecyficationEl(e);
    });

    //Edycja zawartosci zestawu

    function addEventForInputsEquipments()
    {
        var equipmentEdit = document.querySelectorAll(".equipmentEdit");

        function focus()
        {
            var equipmentEdit = document.querySelectorAll(".equipmentEdit");
            var i = getIndex(this, equipmentEdit);

            var t = document.querySelectorAll("#equipmentList > li");

            t[i].style.border = "5px solid yellow";
            t[0].scrollIntoView();
        }

        function blur()
        {
            var equipmentEdit = document.querySelectorAll(".equipmentEdit");
            var i = getIndex(this, equipmentEdit);

            var t = document.querySelectorAll("#equipmentList > li");

            if (this.value == "")
            {
                this.placeholder = "Podaj zawartość zestawu";
            } else
            {
                t[i].textContent = this.value;
            }

            t[i].style.border = "";
        }

        for (var i = 0; i < equipmentEdit.length; i++)
        {
            equipmentEdit[i].addEventListener('focus', focus);
            equipmentEdit[i].addEventListener('blur', blur);
        }
    }

    addEventForInputsEquipments();

    //Usuwanie zawartosci zestawu z edycji

    function removeElement()
    {
        var parentBTN = this.parentNode;
        var parentLi = parentBTN.parentNode;
        if (parentLi.childElementCount > 1)
        {

            var t = document.querySelectorAll("#equipmentList > li");
            var parentT = t[0].parentNode;
            var i = getIndex(parentBTN, parentLi.querySelectorAll("li"));
            parentLi.removeChild(parentBTN);
            parentT.removeChild(t[i]);

            addEventForInputsEquipments();
        }
    }

    function removeElementEvent()
    {
        var removeEquipmentBTN = document.querySelectorAll('li > .removeEquipmentBTN');
        for (var i = 0; i < removeEquipmentBTN.length; i++)
        {
            removeEquipmentBTN[i].addEventListener('click', removeElement);
        }
    }

    removeElementEvent();

    //Dodawanie nowej zawartosci zestawu do edycji

    function addElement(e)
    {
        if (document.querySelectorAll("#equipmentConteiner li").length >= 10)
        {
            showCloud(e, "Można dodać max 10 specyfikacji!");
        } else
        {
            var sc = document.getElementById('equipmentConteiner');
            var su = document.getElementById("equipmentList");
            sc.appendChild(sc.lastElementChild.cloneNode(true));
            su.appendChild(su.lastElementChild.cloneNode(true));

            removeElementEvent();
            addEventForInputsEquipments();
        }

    }

    var newEquipmentBTN = document.querySelector('.addNewEquipmentBTN');
    newEquipmentBTN.addEventListener('click', function (e) {
        addElement(e);
    });





    //Edycja Zdjęcia specyfikacji


    specyficationPhotoEdit.addEventListener('focus', function () {
        var img = document.querySelector(".photoSpecyfication1 > img");
        img.style.border = "5px solid yellow";
        img.scrollIntoView();
    }, false);

    specyficationPhotoEdit.addEventListener('blur', function () {
        var img = document.querySelector(".photoSpecyfication1 > img");

        img.style.border = "";

        if (specyficationPhotoEdit.value == "")
        {
            specyficationPhotoEdit.placeholder = "Wprowadź URL obrazka...";
        } else
        {
            img.src = specyficationPhotoEdit.value;
        }
    }, false);

    //Edycja opisu przedmiotu - czesc 1

    var descriptionEdit = document.querySelector('#descriptionEdit');

    descriptionEdit.addEventListener('focus', function () {
        var t = document.querySelector("#details_desc");
        t.style.border = "5px solid yellow";
        t.scrollIntoView();
        this.style.height = "200px";
    }, false);

    descriptionEdit.addEventListener('blur', function () {
        var t = document.querySelector("#details_desc");
        t.style.border = "";
        this.style.width = "";
        this.style.height = "";

        if (this.value == "")
        {
            this.placeholder = "Wprowadź opis...";
        } else
        {
            t.querySelector("p").textContent = this.value;
        }
    }, false);

    //Edycja Zdjęcia głownego opisu przedmiotu


    descriptionPhotoEdit.addEventListener('focus', function () {
        var img = document.querySelector(".photoSpecyfication2 > img");
        img.style.border = "5px solid yellow";
        img.scrollIntoView();
    }, false);

    descriptionPhotoEdit.addEventListener('blur', function () {
        var img = document.querySelector(".photoSpecyfication2 > img");
        img.style.border = "";

        if (descriptionPhotoEdit.value == "")
        {
            descriptionPhotoEdit.placeholder = "Wprowadź URL obrazka...";
        } else
        {
            img.src = descriptionPhotoEdit.value;
        }
    }, false);

    //Edycja opisu przedmiotu - czesc 2

    var chBoxDescriptionPlus = document.getElementById('chBoxDescriptionPlus');

    chBoxDescriptionPlus.addEventListener('click', function () {
        document.querySelector("#details_desc_plus > p").scrollIntoView();
        if (chBoxDescriptionPlus.checked)
        {
            document.querySelector('#descriptionPlusEdit').removeAttribute('hidden', 'true');
            document.querySelector("#details_desc_plus > p").removeAttribute('hidden', 'true');
        } else
        {
            document.querySelector('#descriptionPlusEdit').setAttribute('hidden', 'true');
            document.querySelector("#details_desc_plus > p").setAttribute('hidden', 'true');
        }
    })


    var descriptionEdit = document.querySelector('#descriptionPlusEdit');

    descriptionPlusEdit.addEventListener('focus', function () {
        var t = document.querySelector("#details_desc_plus > p");
        t.style.border = "5px solid yellow";
        t.scrollIntoView();

        this.style.height = "200px";
    }, false);

    descriptionPlusEdit.addEventListener('blur', function () {
        var t = document.querySelector("#details_desc_plus > p");
        t.style.border = "";
        this.style.width = "";
        this.style.height = "";

        if (this.value == "")
        {
            this.placeholder = "Dodatkowy opis...";
        } else
        {
            t.textContent = this.value;
        }
    }, false);


    //Edycja stopki

    var chBoxFooter = document.getElementById('chBoxFooter');

    chBoxFooter.addEventListener('click', function () {
        document.querySelector("#contact").scrollIntoView();
        if (chBoxFooter.checked)
        {
            document.querySelector('#footerEdit').removeAttribute('hidden', 'true');
            document.querySelector("#contact").removeAttribute('hidden', 'true');

        } else
        {
            document.querySelector('#footerEdit').setAttribute('hidden', 'true');
            document.querySelector("#contact").setAttribute('hidden', 'true');
        }
    })

    var footerEdit = document.querySelector('#footerEdit');

    footerEdit.addEventListener('focus', function () {
        var t = document.querySelector("#contact");

        t.style.border = "5px solid yellow";
        t.scrollIntoView();

        this.style.height = "200px";
    }, false);

    footerEdit.addEventListener('blur', function () {
        var t = document.querySelector("#contact");
        t.style.border = "";
        this.style.width = "";
        this.style.height = "";

        if (this.value == "")
        {
            this.placeholder = "Stopka strony...";
        } else
        {
            t.querySelector("p").textContent = this.value;
        }
    }, false);


    //checkboxy dostawy
    function addCheckBoxEvents()
    {
        document.getElementById('supply').scrollIntoView();
        switch (this.id)
        {
            case "personal":

                if (this.checked)
                    document.querySelector('#supply>ul>li.personal').children[0].removeAttribute('hidden');
                else
                    document.querySelector('#supply>ul>li.personal').children[0].setAttribute('hidden', 'true');
                break;

            case "oneday":

                if (this.checked)
                    document.querySelector('#supply>ul>li.oneday').children[0].removeAttribute('hidden');
                else
                    document.querySelector('#supply>ul>li.oneday').children[0].setAttribute('hidden', 'true');
                break;

            case "COD":

                if (this.checked)
                    document.querySelector('#supply>ul>li.COD').children[0].removeAttribute('hidden');
                else
                    document.querySelector('#supply>ul>li.COD').children[0].setAttribute('hidden', 'true');
                break;

            case "free":

                if (this.checked)
                    document.querySelector('#supply>ul>li.free').children[0].removeAttribute('hidden');
                else
                    document.querySelector('#supply>ul>li.free').children[0].setAttribute('hidden', 'true');
                break;

            case "return":

                if (this.checked)
                    document.querySelector('#supply>ul>li.return').children[0].removeAttribute('hidden');
                else
                    document.querySelector('#supply>ul>li.return').children[0].setAttribute('hidden', 'true');
                break;

            case "risk":

                if (this.checked)
                    document.querySelector('#supply>ul>li.risk').children[0].removeAttribute('hidden');
                else
                    document.querySelector('#supply>ul>li.risk').children[0].setAttribute('hidden', 'true');
                break;
        }
    }

    var checkbox = document.querySelectorAll('fieldset input[type="checkbox"]');
    for (var i = 0; i < checkbox.length; i++)
    {
        checkbox[i].addEventListener('click', addCheckBoxEvents);
    }

    //Okno z wygenerowanym kodem

    //Generowanie kodu
    var generateBTN = document.querySelector('#generateBTN');
    generateBTN.addEventListener('click', function () {
        document.querySelector('#textarea').value = document.querySelector('#contentBox').innerHTML;
        document.querySelector('#template').style.display = 'block';
    });

    //Zaznaczenie calego wygenerowanego kodu po kliknieciu

    var textArea = document.querySelector('#textarea');
    textArea.addEventListener('click', function () {
        textArea.focus();
        textArea.select();
    });

    //Przycisk zamknięcia okna

    var close = document.querySelector("#template img");
    close.addEventListener('click', function () {
        document.querySelector('#template').style.display = 'none';
    });


    //funkcja zwracająca numer elementu LI w liscie UL
    function getIndex(element, LI)
    {
        for (var i in LI)
        {
            if (LI[i] === element)
                return i;
        }
        return -1;
    }
    ;

    //Funkcja pokazująca dymek z podpowiedzią
    function showCloud(event, text)
    {
        var cloud = document.getElementById('cloud');
        cloud.textContent = text;
        cloud.style.top = event.clientY + "px";
        cloud.style.left = event.clientX + "px";
        cloud.removeAttribute('hidden');

        setTimeout(function () {
            cloud.setAttribute('hidden', 'true');
        }, 2000);
    }

    //Wyświetlenie galerii

    function showGallery()
    {
        //$('.boxOnPhotos').load("loadPhotosToGallery.php");
        readGallery();
        document.getElementById('bigGallery').style.display = "block";
    }

    //    function removeAllPhotos()
    //    {
    //        document.location.href = "edycja.php?start=true";
    //    }

        // document.getElementById('removeAllPhotosBTN').addEventListener('click', removeAllPhotos);

    function closeGallery()
    {
        document.getElementById('bigGallery').style.display = "none";
        var p = document.querySelectorAll("#bigGallery .photo");
        imgMinPhoto = document.querySelectorAll('.min');
        for (var i = 0; i < imgMinPhoto.length; i++)
        {
            imgMinPhoto[i].removeEventListener('click', addEventToMinPhoto);
            imgMinPhoto[i].removeEventListener('click', addEventToMinPhoto2);
            p[i].removeEventListener('click', selectPhoto);

        }
    }
       //     minPhoto = document.querySelectorAll('.minPhoto');
       //     for (var i = 0; i < minPhoto.length; i++)
       //     {
       //         minPhoto[i].addEventListener('click', select);
       //     }
           
       //     imgMinPhoto = document.querySelectorAll('.imgMinPhoto');
       //     for (var i = 0; i < imgMinPhoto.length; i++)
       //     {
       //         imgMinPhoto[i].removeEventListener('click', addEventToMinPhoto);
       //     }
           
       //     minPhoto = document.querySelectorAll('.minPhoto');       
       //     for (var i = 0; i < minPhoto.length; i++)
       //     {
       //         minPhoto[i].removeEventListener('click', select);
       //         minPhoto[i].style.background = "";
       //         minPhoto[i].style.border = "";
       //     }
       //     document.querySelector('#bigGallery > h2').textContent = "Twoje zdjęcia";
       //     document.getElementById('addPhotosToGallery').setAttribute("disabled", "");
       //     selectedPhotos.splice(0, selectedPhotos.length);
       

       // function select() {
    
       //     var srcToMyImg = this.querySelector('.imgMinPhoto').src;
       //     if (this.style.background == "")
       //     {
       //         selectedPhotos.push(srcToMyImg);
       //         this.style.background = "green";
       //         this.style.border = "2px solid green";
       //     } else
       //     {
       //         this.style.background = "";
       //         this.style.border = "";
       //         selectedPhotos.forEach(function (el, i) {
       //             if (el == srcToMyImg)
       //                 selectedPhotos.splice(i, 1);
       //         });
       //     }
       // }

    function selectPhotos()
    {
        document.querySelector('#bigGallery h2').textContent = "Zaznacz zdjęcia które chcesz wstawić do galerii w szablonie aukcji";
        document.querySelector('.footerGallery .okBtn').style.display = "block";
        var p = document.querySelectorAll("#bigGallery .photo");
        for (var i = 0; i < p.length; i++)
        {
            p[i].addEventListener('click', selectPhoto);
        }

        showGallery();

    //        imgMinPhoto = document.querySelectorAll('.imgMinPhoto');
    //        minPhoto = document.querySelectorAll('.minPhoto');       
    //        for (var i = 0; i < minPhoto.length; i++)
    //        {
    //            minPhoto[i].addEventListener('click', select);
    //        }
    }


    // Podmiana zdjęć w głównej galerii na podstawie wybranych pozycji.
    function changePhotsOnPage()
    {
        if (!this.classList.contains("okBtnDisabled"))
        {
            var html = "";
            selectedPhotosTab.forEach(function (el, i) {
                html += "<li class=\"photo\"><img src=\"" + el + "\"></li> ";
            });
            document.querySelector('#gallery>ul').innerHTML = html;

            closeGallery();
        }

    }

    document.querySelector('.okBtn').addEventListener('click', changePhotsOnPage);
    document.getElementById('galleryBTN').addEventListener('click', selectPhotos);
    document.querySelector('#bigGallery .close').addEventListener('click', closeGallery);


    //Wybranie zdjęcia z galerii jako foto główne
    function addEventToMinPhoto()
    {
        photo = document.querySelector(".photoSpecyfication1 > img");
        photo.src = this.src;
        closeGallery();
        for (var i = 0; i < imgMinPhoto.length; i++)
        {
            imgMinPhoto[i].removeEventListener('click', addEventToMinPhoto);
        }

    }

    function changeMainPhoto()
    {
        document.querySelector('#bigGallery h2').textContent = "Kliknij zdjęcie, które chcesz wstawić jako główne w szablonie aukcji";
        document.querySelector('.footerGallery .okBtn').style.display = "none";
        showGallery();
        imgMinPhoto = document.querySelectorAll('.min');
        for (var i = 0; i < imgMinPhoto.length; i++)
        {
            imgMinPhoto[i].addEventListener('click', addEventToMinPhoto);
        }
    }

    document.querySelector('#selectMainPhotoBTN').addEventListener('click', changeMainPhoto, false);

    //Wybranie zdjęcia z galerii jako foto opisu
    function addEventToMinPhoto2()
    {
        photo = document.querySelector(".photoSpecyfication2 > img");
        photo.src = this.src;
        closeGallery();
        for (var i = 0; i < imgMinPhoto.length; i++)
        {
            imgMinPhoto[i].removeEventListener('click', addEventToMinPhoto2);
        }

    }

    function changeDescriptionPhoto()
    {
        document.querySelector('#bigGallery h2').textContent = "Kliknij zdjęcie, które chcesz wstawić przy opisie w szablonie aukcji";
        document.querySelector('.footerGallery .okBtn').style.display = "none";
        showGallery();
        imgMinPhoto = document.querySelectorAll('.min');
        for (var i = 0; i < imgMinPhoto.length; i++)
        {
            imgMinPhoto[i].addEventListener('click', addEventToMinPhoto2);
        }
    }

    document.querySelector('#selectDescPhotoBTN').addEventListener('click', changeDescriptionPhoto, false);


    // GALERIA - ZAWARTOŚĆ ZEWNĘTRZNEGO PLIKU

    var bigPhotoLook = document.querySelector("#bigGallery .bigPhotoLook");
    var loupe = document.querySelectorAll("#bigGallery .look");
    var delPhoto = document.querySelectorAll("#bigGallery .delete");
    var minPhoto = document.querySelectorAll("#bigGallery .min");
    var photo = document.querySelectorAll("#bigGallery .photo");
    var close = document.querySelector("#bigGallery .close");
    var deleteAllPhotosIcon = document.querySelector("#bigGallery .deleteAllPhotosIcon");
    var OK = document.querySelector("#bigGallery .okBtn");

    var closeBtn = document.querySelector("#bigGallery .closeBtn");
    var arrowLeft = document.querySelector("#bigGallery .left");
    var arrowRight = document.querySelector("#bigGallery .right");

    var index;
    var selectedPhotosTab = new Array;

    closeBtn.addEventListener('click', function () {
        arrowLeft.style.visibility = "";
        arrowRight.style.visibility = "";
        bigPhotoLook.style.display = "none";
    });

    Array.prototype.findIndexElement = function (element)
    {
        for (var i = 0; i < this.length; i++)
        {
            if (this[i] === element)
            {
                return i;
                break;
            }
            return false;
        }
    };
    
    //Usuwanie wszystkich zdjęć
    deleteAllPhotosIcon.addEventListener('click', function(){
        if(confirm("Czy na pewno usunąć wszystkie zdjęcia z Galerii?"))
        {
            window.open("deletePhotos.php");
            window.location.reload();
        }
        
    }, false);

    function openBigPhoto()
    {
        bigPhotoLook.querySelector("#bigGallery .bigPhoto").src = this.parentNode.parentNode.querySelector("#bigGallery .min").src;
        bigPhotoLook.style.display = "";

        for (var i = 0; i < minPhoto.length; i++)
        {
            if (minPhoto[i].src === bigPhotoLook.querySelector("#bigGallery .bigPhoto").src)
            {
                index = i;
                break;
            }
        }

        if (index === minPhoto.length - 1)
        {
            arrowRight.style.visibility = "hidden";
        }
        if (index === 0)
        {
            arrowLeft.style.visibility = "hidden";
        }

    }

    function selectPhoto()
    {
        this.classList.toggle("selected");
        var src = this.querySelector("#bigGallery .min").src;

        if (this.classList.contains("selected"))
        {
            selectedPhotosTab.push(src);
        } else
        {
            selectedPhotosTab.splice(selectedPhotosTab.findIndexElement(src), 1);
        }

        if (selectedPhotosTab.length !== 0)
        {
            OK.classList.remove("okBtnDisabled");
        } else
        {
            OK.classList.add("okBtnDisabled");
        }

        console.log(selectedPhotosTab.length);
    }

    function changeOnNextPhoto()
    {
        if (index !== (minPhoto.length - 1))
        {
            index++;
            if (index === minPhoto.length - 1)
            {
                arrowRight.style.visibility = "hidden";
            }
            arrowLeft.style.visibility = "";
            bigPhotoLook.querySelector("#bigGallery .bigPhoto").src = minPhoto[index].src;
        }
    }

    function changeOnPreviousPhoto()
    {
        if (index !== 0)
        {
            index--;
            if (index === 0)
            {
                arrowLeft.style.visibility = "hidden";
            }

            arrowRight.style.visibility = "";
            bigPhotoLook.querySelector("#bigGallery .bigPhoto").src = minPhoto[index].src;
        }
    }

    arrowRight.addEventListener('click', changeOnNextPhoto);
    arrowLeft.addEventListener('click', changeOnPreviousPhoto);
    close.addEventListener('click', function () {
        this.parentNode.parentNode.style.display = "none";
    });

    function deletePhoto()
    {
        var box = this.parentNode.parentNode;
        box.style.display = "none";

        selectedPhotosTab.splice(selectedPhotosTab.findIndexElement(box.querySelector("#bigGallery .min").src), 1);

        console.log(selectedPhotosTab.length);
    }

    for (var i = 0; i < photo.length; i++)
    {
        loupe[i].addEventListener('click', function (e) {
            e.stopPropagation();
        });
        delPhoto[i].addEventListener('click', function (e) {
            e.stopPropagation();
        });


        loupe[i].addEventListener('click', openBigPhoto);
        delPhoto[i].addEventListener('click', deletePhoto);
    }
      
    function clickInEmptyGallery()
    {
        var fileToUploadBTN = document.getElementById('plik');
        closeGallery();
        fileToUploadBTN.click();
    }
    var galleryEmptyComunicate = document.querySelector('strong.error');
    //galleryEmptyComunicate.addEventListener('click', clickInEmptyGallery);
    

    




    //Funkcje odpowiedzialne za upload plików w Ajax
    
    
    function wyslijPlik() 
                {
                var formularz=new FormData(); //tworzymy nowy formularz do wysłania
                for(i=0;i<document.getElementById("plik").files.length; i++)
                    formularz.append("fileToUpload[]", document.getElementById("plik").files[i]); //dodajemy do formularza pole z naszym plikiem

                /* wysyłamy formularz za pomocą AJAX */
                var xhr=new XMLHttpRequest();
                xhr.upload.addEventListener("progress", postepWysylania, false);
                xhr.addEventListener("load", zakonczenieWysylania, false);
                xhr.addEventListener("error", bladWysylania, false);
                xhr.addEventListener("abort", przerwanieWysylania, false);
                xhr.open("POST", "./upload.php", true);
                xhr.send(formularz);
                }

                function postepWysylania(event) {
                    var procent=Math.round((event.loaded/event.total)*100);
                    document.getElementById("status").innerHTML="Wysłano "+konwersjaBajtow(event.loaded)+" z "+konwersjaBajtow(event.total)+" ("+procent+"%)";
                    document.getElementById("postep").value=procent;
                }

                function zakonczenieWysylania(event) {
                    document.getElementById("status").innerHTML=event.target.responseText;
                }

                function bladWysylania(event) {
                    document.getElementById("status").innerHTML="Wysyłanie nie powiodło się";
                }

                function przerwanieWysylania(event) {
                    document.getElementById("status").innerHTML="Wysyłanie zostało przerwane";
                }

                function konwersjaBajtow(bajty) {
                    var kilobajt=1024;
                    var megabajt=kilobajt*1024;
                    var gigabajt=megabajt*1024;
                    var terabajt=gigabajt*1024;

                    if (bajty>=0 && bajty<kilobajt) return bajty+" B";
                    else if(bajty>=kilobajt && bajty<megabajt) return Math.round(bajty/kilobajt)+" kB";
                    else if(bajty>=megabajt && bajty<gigabajt) return Math.round(bajty/megabajt)+" MB";
                    else if(bajty>=gigabajt && bajty<terabajt) return Math.round(bajty/gigabajt)+" GB";
                    else if(bajty>=terabajt) return Math.round(bajty/terabajt)+" TB";
                    else return bajty+" B";
                }

                function readGallery()
                {
                    var xml = new XMLHttpRequest();
                    xml.open("GET","./gallegry.php", true);
                    xml.send();
                    xml.onreadystatechange = function(){
                    
                    //4 = dokument został w pełni przesłany i jest gotowy do użycia
                    if ( xml.readyState == 4 ) {
                        document.querySelector("#minPhotos>.boxOnPhotos").innerHTML=xml.responseText;
                        // xml.responseXML zawiera zwrócony dokument xml
                        // xml.responseText zawiera zwrócony tekst
                        // (if no XML document was provided)    
                        //czyścimy obiekt, dla zwolnienia pamięci
                        xml = null;
                    }

                    
                    //selectPhotos();
                }
            }
});
        