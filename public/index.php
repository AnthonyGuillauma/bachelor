<?php 
// -- INDEX --

//Capture les erreurs internes non contrôlées
try{
    //Initialisation de la session
    require_once "../conf/SessionsConf.php";
    
    //Initialisation du routeur
    require_once "../core/Router.php";
    $router = new Router();

    //Affiche la page appropriée
    $router->run();
}
//Si une erreur non capturée :
// - Enregistre dans le fichier log
// - Renvoie une erreur 500
catch(Exception $error){
    error_log("ERROR : [" . date("Y-m-d H:i:s") . "] " . $error->getMessage() . " dans " . $error->getFile() . " à la ligne " . $error->getLine() . "\n", 3, "../write/logs/errors.txt");
    http_response_code(500);
    echo "Erreur 500 - le serveur a rencontré un problème.";
}

?>