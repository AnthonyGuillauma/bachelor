<?php 

/**
 * Classe mère des controlleurs.
 */
class Controller {

    /** @var object Chemins des vues */
    protected object $VIEWS;
    /** @var object Chemins des fichiers css */
    protected object $STYLES;
    /** @var object Chemins des fichiers javascript */
    protected object $JS; 
    /** @var object Titre des pages */
    protected object $TITLES;

    /**
     * Initialise les données pour les controlleurs.
     * @return void
     */
    public function __construct(){
        require_once("../conf/PathsAndNamesConf.php");
        $this->VIEWS = $paths->views;
        $this->STYLES = $paths->styles;
        $this->JS = $paths->js;
        $this->TITLES = $names;
    }

    /**
     * Ajoute la vue dans la réponse.
     * @param string $path Chemin de la vue
     * @param string $title Titre de la page
     * @param array $stylesheets Les fichiers css à ajouter (fichier main déjà prit en compte)
     * @param array $datas Données à transmettre à la vue
     * @return void
     */
    public function displayView(string $path, string $title, array $stylesheets, array $datas = []) {
       
        //-> Données récupérables par les vues
        //Ajout du fichier main css
        $stylesheets[] = $this->STYLES->main;
        //Noms des fichiers js pour les vues
        $js = $this->JS;
        //Est-ce que l'utilisateur est connecté ?
        $isConnected = $this->isConnected();
        //Le header pour la vue
        $header = $this->VIEWS->header;
        //Le footer pour la vue
        $footer = $this->VIEWS->footer;

        //-> Création de la vue
        include($this->VIEWS->head);
        include($path);
    }

    /**
     * Redirige le client vers l'URL spécifiée et arrête le script.
     * @param string $url L'URL où redirigée le client
     * @return void
     */
    public function redirectTo(string $url){
        header("Location: $url"); 
        exit;
    }

    /**
     * Vérifie si la session cliente est associée à un compte.
     * @return bool Est-ce que l'utilisateur est connecté ?
     */
    public function isConnected(){
        if (isset($_SESSION["username"])){
            return true;
        }
        return false;
    }
}
?>