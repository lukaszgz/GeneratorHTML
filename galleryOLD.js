var bigPhotoLook = document.querySelector("#bigGallery .bigPhotoLook");
var loupe = document.querySelectorAll("#bigGallery .look");
var delPhoto = document.querySelectorAll("#bigGallery .delete");
var minPhoto = document.querySelectorAll("#bigGallery .min");
var photo = document.querySelectorAll("#bigGallery .photo");
var close = document.querySelector("#bigGallery .close");
var deleteSelected = document.querySelector("#bigGallery .deleteSelectedIcon");
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
    photo[i].addEventListener('click', selectPhoto);

}