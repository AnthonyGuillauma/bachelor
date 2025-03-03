<?php 
require_once("../app/controllers/Controller.php");

/**
 * Classe du controlleur pour l'affichage des pages.
 */
class MainController extends Controller {

    /**
     * Affiche la page d'accueil du site.
     * @return void
     */
    public function pageHome() {
        //Affichage de la page
        $this->displayView($this->VIEWS->home, $this->TITLES->home, [$this->STYLES->home]);
    }

    /**
     * Affiche la page de présentation des personnages du site.
     * @return void
     */
    public function pageCharacters(){
        //Initialisation du modèle des personnages
        require_once("../app/models/CharactersModel.php");
        $model = new CharactersModel();
        //Récupération des personnages
        $characters = [];
        foreach ($model->getCharacters() as $character){
            $characters[$character->id] = [
                "name" => $character->name,
                "voice" => $character->voice,
                "description" => $character->description,
                "origin" => $character->origin
            ];
        }
        //Récupération des différentes origines des personnages
        //(pour les organiser sur l'affichage)
        $origins = [];
        foreach ($model->getOrigins() as $origin){
            $origins[$origin->id] = [
                "name" => $origin->name,
                "display_order" => $origin->display_order
            ];
        }
        //Affichage de la page
        $this->displayView($this->VIEWS->characters, $this->TITLES->characters, [$this->STYLES->characters], ["characters" => $characters, "origins" => $origins]);
    }

    /**
     * Affiche la page de présentation de l'univers du jeu.
     * @return void
     */
    public function pageWorld(){
        //Affiche la page
        $this->displayView($this->VIEWS->world, $this->TITLES->world, [$this->STYLES->world]);
    }

    /**
     * Affiche la page des actualités du jeu.
     * @return void
     */
    public function pageNews(){
        //Initalisation du modèle
        require_once("../app/models/NewsModel.php");
        $model = new NewsModel();
        //Récupération des articles
        $news = $model->getNews();
        //Affichage de la page
        $this->displayView($this->VIEWS->news, $this->TITLES->news, [$this->STYLES->news], ["news" => $news]);
    }
}
?>