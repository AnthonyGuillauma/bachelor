<?php 
require_once("../app/models/Model.php");

/**
 * Classe du modèle pour l'accès aux données des personnages du jeu.
 */
class CharactersModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    /**
     * Récupère les informations de tous les personnages du jeu.
     * @return array[Character] Liste des personnages.
     * @throws ModelException Si une erreur dans la manipulation des données.
     */
    public function getCharacters(){
        //Initialisation de la connexion
        $connection = $this->getConnection();
        //Récupération des informations
        $query = $connection->query("SELECT * FROM characters WHERE is_displayed = 1;");
        $result = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new Character($row["id"], $row["name"], $row["voice"], $row["description"], $row["origin"]);
        }
        //Ferme la connexion
        $this->closeConnection();
        return $result;
    }

    /**
     * Récupère la liste des informations des origines possibles pour les personnages.
     * @return array[CharacterOrigin] Liste des origines.
     * @throws ModelException Si une erreur dans la manipulation des données.
     */
    public function getOrigins(){
        //Initialisation de la connexion
        $connection = $this->getConnection();
        //Récupération des informations
        $query = $connection->query("SELECT * FROM places_of_origin;");
        $result = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new CharacterOrigin($row["id"], $row["name"], $row["display_order"]);
        }
        //Ferme la connexion
        $this->closeConnection();
        return $result;
    }
}


/**
 * Classe qui représente un personnage du jeu.
 */
class Character{
    /** @var int Identifiant unique du personnage. */
    public int $id;
    /** @var string Nom du personnage. */
    public string $name;
    /** @var string Nom de la voix du personnage. */
    public string $voice;
    /** @var string Description du personnage. */
    public string $description;
    /** @var string Identifiant unique de l'origine du personnage. */
    public int $origin;

    /**
     * Initialise les informations du personnage
     * @param int $id Identifiant unique du personnage.
     * @param string $name Nom du personnage.
     * @param string $voice Nom de la voix du personnage.
     * @param string $description Description du personnage.
     * @param string $origin Identifiant unique de l'origine du personnage.
     * @return void
     */
    public function __construct($id, $name, $voice, $description, $origin) {
        $this->id = $id;
        $this->name = $name;
        $this->voice = $voice;
        $this->description = $description;
        $this->origin = $origin;
    }
}

/**
 * Classe qui représente une origine possible pour les personnages.
 */
class CharacterOrigin{
    /** @var int Identifiant unique de l'origine. */
    public int $id;
    /** @var string Nom de l'origine. */
    public string $name;
    /** @var int Ordre de l'origine dans l'affichage. */
    public int $display_order;

    /**
     * Initialise les informations de l'origine
     * @param int $id Identifiant unique de l'origine.
     * @param string $name Nom de l'origine.
     * @param int $display_order Ordre de l'origine dans l'affichage.
     * @return void
     */
    public function __construct($id, $name, $display_order)
    {
        $this->id = $id;
        $this->name = $name;
        $this->display_order = $display_order;
    }
}
?>