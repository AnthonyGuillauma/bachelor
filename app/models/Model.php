<?php 

/**
 * Classe mère des modèles.
 */
class Model {
    /** @var string Nom du serveur la base de donnée. */
    private string $host;
    /** @var string Nom de la base de donnée. */
    private string $database;
    /** @var string Nom de l'utilisateur pour accèder à la base de donnée. */
    private string $user;
    /** @var string Mot de passe pour accèder à la base de donnée. */
    private string $password;
    /** @var ?PDO Connexion courante à la base de donnée. */
    private ?PDO $pdo = null;

    /**
     * Initialise les données pour les modèles. 
     * @return void
     */
    public function __construct() {
        //Récupération de la configuration de la base de donnée
        require_once("../conf/DatabaseConf.php");
        //Enregistrement des données de la ocnfiguration
        $this->host = $connection["host"];
        $this->database = $connection["database"];
        $this->user = $connection["user"];
        $this->password = $connection["password"];
    }

    /** 
     * Créee une nouvelle connexion ou retourne la connexion courante.
     * @return PDO La connexion courante à la base.
    */
    public function getConnection(){
        //Si aucune connexion n'a été initialisée...
        if ($this->pdo == null){
            //...créee uen nouvelle connexion
            $this->pdo =  new PDO("mysql:host=$this->host;dbname=$this->database;", $this->user, $this->password);
        }
        //Retourne la connexion
        return $this->pdo;
    }

    /**
     * Ferme la connexion courante à la base de donnée.
     * @return void
     */
    public function closeConnection(){
        $this->pdo = null;
    }
}

/**
 * Classe des exceptions liées à la manipulation des données dans les modèles.
 */
class ModelException extends Exception{

    public function __construct(string $message, $previous = null) {
        parent::__construct($message, $previous);
    }

    public function __toString() {
        return "Erreur dans le modèle : $this->message";
    }
}
?>