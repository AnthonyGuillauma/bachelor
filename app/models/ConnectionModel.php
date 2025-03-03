<?php 
require_once("../app/models/Model.php");

/**
 * Classe du modèle lié aux comptes utilisateurs.
 */
class ConnectionModel extends Model{

    public function __construct() {
        parent::__construct();
    }

    /**
     * Ajoute un nouveau compte utilisateur.
     * @param string $email Email du nouveau compte.
     * @param string $password Mot de passe du nouveau compte.
     * @param string $username Pseudo du nouveau compte.
     * @param string $firstname Prénom de la personne associée au nouveau compte.
     * @param string $lastname Nom de famille de la personne associée au nouveau compte.
     * @return bool True si la création a réussie, false sinon.
     * @throws InvalidEmailException Si le format de l'email est invalide.
     * @throws InvalidPasswordException Si le format du mot de passe est invalide.
     * @throws DoubleEmailException Si l'email est déjà associé à un compte.
     * @throws InvalidUsernameException Si le format du pseudo est invalide.
     * @throws InvalidFirstNameException Si le format du prénom est invalide.
     * @throws InvalidLastNameException Si le format du nom de famille est invalide.
     * @throws ModelException Si une erreur dans la manipulation des données.
     */
    public function addAccount(string $email, string $password, string $username, string $firstname, string $lastname){
        //Vérification de la conformité des données
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //le format de l'email est invalide.
            throw new InvalidEmailException();
        }
        if (strlen($password) < 8){ //Le format du mot de passe est invalide.
            throw new InvalidPasswordException();
        }
        if ($this->isEmailUses($email)){ //L'email est déjà associé à un compte.
            throw new DoubleEmailException();
        }
        if (strlen($username) < 4){ //Le format du pseudo est invalide.
            throw new InvalidUsernameException();
        }
        if (strlen($firstname) < 1){ //Le format du prénom est invalide.
            throw new InvalidFirstNameException();
        }
        if (strlen($lastname) < 1){ //Le format du nom de famille est invalide.
            throw new InvalidLastNameException();
        }
        try{
            //Initialisation de la connexion
            $connection = $this->getConnection();
            //Ajout du nouveau compte utilisateur
            $query = $connection->prepare("INSERT INTO accounts(email, password, username, first_name, last_name, created_at) VALUES(:email, :password, :username, :firstname, :lastname, NOW());");
            $query->execute([
                "email" => $email,
                "password" => password_hash($password, PASSWORD_DEFAULT),
                "username" => $username,
                "firstname" => $firstname,
                "lastname" => $lastname
            ]);
            //Si une ligne a bien été ajoutée
            if ($query->rowCount() > 0){
                return true;
            }
            return false;
        }
        //Erreur lors de la manipulation de la base des données
        catch(Exception $error){
            throw new ModelException($error);
        }
        finally{
            //Ferme la connexion
            $this->closeConnection();
        }
    }

    /**
     * Vérifie si l'email fourni est déjà associé à un compte.
     * @param string $email Email à vérifier
     * @return bool True si l'email est déjà associé, false sinon.
     * @throws ModelException Si une erreur dans la manipulation des données.
     */
    public function isEmailUses(string $email){
        try{
            //Initialisation de la connexion
            $connection = $this->getConnection();
            //Vérification si l'email est déjà associé
            $query = $connection->prepare("SELECT COUNT(*) AS 'nombre_email' FROM accounts WHERE email = :email;");
            $query->execute(["email" => $email]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            //Si il est déjà associé
            if ($result["nombre_email"] > 0){
                return true;
            }
            //S'il n'est pas associé
            return false;
        }
        //Erreur lors de la manipulation de la base des données
        catch(Exception $error){
            throw new ModelException($error);
        }
        finally{
            //Ferme la connexion
            $this->closeConnection();
        }
    }

    /**
     * Vérifie si les données de connexion fournis correspondent à un compte utilisateur.
     * @param string $email Email de connexion.
     * @param string $password Mot de passe de connexion.
     * @return bool True si elles correspondent, sinon false.
     * @throws ModelException Si une erreur dans la manipulation des données.
     */
    public function isLoginValid(string $email, string $password){
        try{
            //Initialisation de la connexion
            $connection = $this->getConnection();
            //Récupération d'un compte lié à cette email
            $query = $connection->prepare("SELECT password FROM accounts WHERE email = :email;");
            $query->execute(["email" => $email]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            //Si un compte a été trouvé avec un mot de passe
            if($result && isset($result["password"])){
                //Si le mot de passe est valide
                if (password_verify($password, $result["password"])){
                    //La connexion est valide
                    return true;
                }
            }
            //La connexion est invalide
            return false;
        }
        //Erreur lors de la manipulation de la base des données
        catch(Exception $error){
            throw new ModelException($error);
        }
        finally{
            //Ferme la connexion
            $this->closeConnection();
        }
    }

    /**
     * Récupère les informations d'un compte associé à l'email.
     * @return Account|false Les informations du compte s'il existe, false sinon.
     * @throws ModelException Si une erreur dans la manipulation des données.
     */
    public function getUser($email){
        try{
            //Initialisation de la connexion
            $connection = $this->getConnection();
            //Récupération des informations du compte
            $query = $connection->prepare("SELECT username, first_name, last_name, last_login FROM accounts WHERE email = :email;");
            $query->execute(["email" => $email]);
            $result = $query->fetch(PDO::FETCH_ASSOC);
            //Si le compte existe
            if($result){
                //Renvoie les informations du compte
                $account = new Account($email, $result["username"], $result["first_name"], $result["last_name"], date("Y-m-d H:i:s"), $result["last_login"]);
                return $account;
            }
            //Le compte n'existe pas
            return false;
        }
        //Erreur lors de la manipulation de la base des données
        catch(Exception $error){
            throw new ModelException($error);
        }
        finally{
            //Ferme la connexion
            $this->closeConnection();
        }
    }

    /**
     * Modifie la date de dernière connexion d'un utilisateur.
     * @param string $email Email du compte utilisateur.
     * @param string $date_login Date de la dernière connexion du compte au format YYYY-MM-DD HH:MM:SS.
     * @return bool True si la modification a fonctionée, false sinon.
     * @throws ModelException Si une erreur dans la manipulation des données.
     */
    public function setLastLogin($email, $date_login){
        try{
            //Initialisation de la connexion
            $connection = $this->getConnection();
            //Mise à jour de la date de dernière connexion
            $query = $connection->prepare("UPDATE accounts SET last_login = :date_login WHERE email = :email;");
            $query->execute([
                "date_login" => $date_login,
                "email" => $email
            ]);
            //Si la modification a fonctionnée
            if ($query->rowCount() > 0){
                return true;
            }
            //La modification n'a pas fonctionnée
            return false;
        }
        //Erreur lors de la manipulation de la base des données
        catch(Exception $error){
            throw new ModelException($error);
        }
        finally{
            //Ferme la connexion
            $this->closeConnection();
        }
    }
}

/**
 * Classe qui représente un compte utilisateur.
 */
class Account{
    /** @var string Email lié au compte */
    public string $email;
    /** @var string Pseudo lié au compte */
    public string $username;
    /** @var string Prénom lié au compte */
    public string $firstname;
    /** @var string Nom de famille lié au compte */
    public string $lastname;
    /** @var string Date de la création du compte au format YYYY-MM-DD HH:MM:SS */
    public string $created_at;
    /** @var string Date de dernière connexion au format YYYY-MM-DD HH:MM:SS */
    public ?string $last_login;

    /**
     * Initialise les informations du compte.
     * @param string $email Email lié au compte
     * @param string $username Pseudo lié au compte
     * @param string $firstname Prénom lié au compte
     * @param string $lastname Nom de famille lié au compte
     * @param string $created_at Date de la création du compte au format YYYY-MM-DD HH:MM:SS
     * @param ?string $last_login Date de dernière connexion au format YYYY-MM-DD HH:MM:SS
     * @return void
     */
    public function __construct(string $email, string $username, string $firstname, string $lastname, string $created_at, ?string $last_login) {
        $this->email = $email;
        $this->username = $username;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->created_at = $created_at;
        $this->last_login = $last_login;
    }
}

/**
 * Exception lié à un email invalide
 */
class InvalidEmailException extends ModelException{

    public function __construct() {
        parent::__construct("Format de l'email invalide.");
    }
}

/**
 * Exception lié à un mot de passe invalide
 */
class InvalidPasswordException extends ModelException{

    public function __construct() {
        parent::__construct("Format du mot de passe invalide.");
    }
}

/**
 * Exception lié à un pseudo invalide
 */
class InvalidUsernameException extends ModelException{

    public function __construct() {
        parent::__construct("Nom d'utilisateur invalide.");
    }
}

/**
 * Exception lié à un email en double
 */
class DoubleEmailException extends ModelException{

    public function __construct() {
        parent::__construct("Email déjà utilisé.");
    }
}

/**
 * Exception lié à un prénom invalide
 */
class InvalidFirstNameException extends ModelException{

    public function __construct() {
        parent::__construct("Format du prénom invalide.");
    }
}

/**
 * Exception lié à un nom de famille invalide
 */
class InvalidLastNameException extends ModelException{

    public function __construct() {
        parent::__construct("Format du nom de famille invalide.");
    }
}