<?php

/**
 * Classe de routage des requêtes clientes.
 */
class Router {

    /**
     * Appelle le bon routeur en fonction de l'URL reçue.
     * @return void
     */
    public function run() {

        //URL de la requête
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $prefix = "/web/public/index.php";
        if (str_starts_with($url, $prefix)){
            $url = substr($url, strlen($prefix));
        }
        //Méthode de la requête
        $method = $_SERVER['REQUEST_METHOD'];

        //Méthode GET : Demande de page
        if ($method == "GET") {
            if ($url == "/" || $url == ""){ //Page d'accueil
                include_once("../app/controllers/MainController.php");
                $controller = new MainController();
                $controller->pageHome();
            }
            elseif ($url == "/characters"){ //Page des personnages du jeu
                include_once("../app/controllers/MainController.php");
                $controller = new MainController();
                $controller->pageCharacters();
            }
            elseif ($url == "/world"){ //Page de la présentation de l'univers du jeu
                include_once("../app/controllers/MainController.php");
                $controller = new MainController();
                $controller->pageWorld();
            }
            elseif ($url == "/news"){ //Page des dernières actualités du jeu
                include_once("../app/controllers/MainController.php");
                $controller = new MainController();
                $controller->pageNews();
            }
            elseif($url == "/login"){ //Page de connexion
                include_once("../app/controllers/ConnectionController.php");
                $controller = new ConnectionController();
                $controller->pageLogin();
            }
            elseif($url == "/signin"){ //Page d'inscription
                include_once("../app/controllers/ConnectionController.php");
                $controller = new ConnectionController();
                $controller->pageSignin();
            }
            else{ //Page introuvable
                echo "404 - Page introuvable.";
            }
        }

        //Méthode POST : Envoie de données
        else if ($method == "POST") {
            if($url == "/login"){ //Validation du formulaire de connexion
                include_once("../app/controllers/ConnectionController.php");
                $controller = new ConnectionController();
                $controller->login();
            }
            elseif($url == "/signin"){ //Validation du formulaire d'inscription
                include_once("../app/controllers/ConnectionController.php");
                $controller = new ConnectionController();
                $controller->signin();
            }
            elseif($url == "/logout"){ //Demande de déconnexion
                include_once("../app/controllers/ConnectionController.php");
                $controller = new ConnectionController();
                $controller->logout();
            }
            else{ //Erreur dans l'envoi des données
                echo "404 - Page introuvable.";
            }
        }
        
        //Autres méthodes
        else { //Requête incomprise
            echo "404 - Page introuvable.";
        }
    }
}
?>
