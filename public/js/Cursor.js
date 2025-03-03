
/**
 * Déplace le nouveau curseur à chaque mouvement de souris
 */
document.addEventListener("DOMContentLoaded", function () {
    const cursor = document.querySelector(".cursor");
    document.addEventListener("mousemove", (e) => {
        cursor.style.top = `${e.clientY}px`;
        cursor.style.left = `${e.clientX}px`;
    });

/**
 * Affiche une trainée derrière la souris
 * @param {int} x Coordonnée x de la souris
 * @param {int} y Coordonnée y de la souris
 */
function createTrail(x, y) {
    //Affiche une nouvelle trainée
    const trail = document.createElement("div");
    trail.classList.add("trail");
    document.body.appendChild(trail);
    trail.style.top = `${y}px`;
    trail.style.left = `${x}px`;
    //Supprime la trainée après 2 secondes
    setTimeout(() => {
        trail.style.opacity = "0";
        setTimeout(() => trail.remove(), 200);
    }, 50);
    }
    //Réattache la nouvelle trainée à la nouvelle position
    document.addEventListener("mousemove", (e) => {
        createTrail(e.clientX, e.clientY);
    });
});