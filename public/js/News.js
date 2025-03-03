currentNewsOpened = null;

/**
 * Affiche le contenu de l'article avec l'id fourni.
 * @param {int} id Identifiant unique de l'article
 */
function openNews(id){
    if (id != currentNewsOpened){
        if (currentNewsOpened != null){
            document.getElementById("news-" + currentNewsOpened).classList.add("article-closed");
            document.getElementById("button-news-" + currentNewsOpened).classList.remove("button-article-chosen");
        }
        document.getElementById("news-" + id).classList.remove("article-closed");
        document.getElementById("button-news-" + id).classList.add("button-article-chosen");
        currentNewsOpened = id;
    }
}