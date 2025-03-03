let isBurgerMenuOpen = false;

/**
 * Affiche ou ferme le menu burger pour mobile.
 * @return {void}
 */
function changeBurgerMenuState(){
    const menu = document.getElementById("navigation-menu");
    if (isBurgerMenuOpen){
        menu.classList.add("burger-menu-close");
        isBurgerMenuOpen = false;
    }
    else{
        menu.classList.remove("burger-menu-close");
        isBurgerMenuOpen = true;
    }
}