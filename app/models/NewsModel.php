<?php 
require_once("../app/models/Model.php");

/**
 * Classe du modèle lié aux actualités du jeu.
 */
class NewsModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    /**
     * Récupère toutes les articles du jeu.
     * @return array[News] Liste des articles.
     */
    public function getNews(){
        //Initialise la connexion
        $connection = $this->getConnection();
        //Récupération des articles
        $query = $connection->query("SELECT n.id, n.title, n.content, a.username, n.published_at FROM news n JOIN accounts a ON n.author = a.id WHERE n.status = 'published' ORDER BY n.published_at DESC;");
        $result = [];
        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $result[] = new News($row["id"], $row["title"], $row["content"], $row["username"], $row["published_at"]);
        }
        //Ferme la connexion
        $this->closeConnection();
        return $result;
    }
}

/**
 * Classe qui représente un article.
 */
class News{
    /** @var int Identifiant unique de l'article. */
    public int $id;
    /** @var string Titre de l'article. */
    public string $title;
    /** @var string Contenu de l'article. */
    public string $content;
    /** @var string Auteur de l'article. */
    public string $author;
    /** @var string Date de création de l'article. */
    public string $date;

    /**
     * Initialise les informations de l'article
     * @param int $id Identifiant unique de l'article.
     * @param string $title Titre de l'article.
     * @param string $content Contenu de l'article.
     * @param string $author Auteur de l'article.
     * @param string $date Date de création de l'article.
     * @return void
     */
    public function __construct($id, $title, $content, $author, $date) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->author = $author;
        $this->date = $date;
    }
}