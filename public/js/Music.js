let isBackgroundMusicMuted = true;
let firstClick = true;

//Si l'utilisateur a un cookie qu'il a activé la musique lors des précédente page, 
//lance la musique au prochain clic sur la page
if (getCookieMusic() == "true") {
    document.addEventListener('click', function() {
        if (firstClick){
            changeBackgroundMusicState();
            firstClick = false;
        }
    });
}

/**
 * Allume ou éteint la musique.
 * @return {void}
 */
function changeBackgroundMusicState(){
    event.stopPropagation();
    if (isBackgroundMusicMuted) {
        document.getElementById("background-music").play();
        document.getElementById("buttonBackgroundMusic").src = "assets/icons/unmuted.png";
        isBackgroundMusicMuted = false;
        document.cookie = "music=true;";
    }
    else{
        document.getElementById("background-music").pause();
        document.getElementById("buttonBackgroundMusic").src = "assets/icons/muted.png";
        isBackgroundMusicMuted = true;
        document.cookie = "music=none;";
    }
}

function getCookieMusic() {
    let match = document.cookie.match(new RegExp('(^| )music=([^;]+)'));
    return match ? match[2] : null;
}