function myfunc() {
    let mymenu = document.querySelector(".menu_area");
    let changeImg = document.querySelector(".img_change");

    if (mymenu.style.maxHeight) {
        mymenu.style.maxHeight = null;
        changeImg.setAttribute('src', 'img/menu_icon_open.png');
    } else {
        mymenu.style.maxHeight = mymenu.scrollHeight + "px";
        changeImg.setAttribute('src', 'img/menu_icon_close.png');
    }
}

function myfunc_admin() {
    let mymenu = document.querySelector(".menu_area");
    let changeImg = document.querySelector(".img_change");

    if (mymenu.style.maxHeight) {
        mymenu.style.maxHeight = null;
        changeImg.setAttribute('src', '../img/menu_icon_open.png');
    } else {
        mymenu.style.maxHeight = mymenu.scrollHeight + "px";
        changeImg.setAttribute('src', '../img/menu_icon_close.png');
    }
}