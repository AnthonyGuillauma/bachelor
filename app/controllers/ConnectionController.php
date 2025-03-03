<?php 
require_once("../app/controllers/Controller.php");
require_once("../app/controllers/MainController.php");

/**
 * Classe du controlleur pour les accès aux comptes utilisateurs.
 */
class ConnectionController extends Controller {

    /**
     * Affiche la page de connexion si l'utilisateur n'est pas connecté.
     * Sinon, il est redirigé à la page d'accueil.
     * @return void
     */
    public function pageLogin(){
        //Si l'utilisateur est déjà connecté...
        if ($this->isConnected()){
            //...redirection à la page d'accueil
            $this->redirectTo("");
        }
        //Sinon s'il n'est pas connecté...
        else{
            //...affiche la page de connexion
            $this->displayView($this->VIEWS->login, $this->TITLES->login, [$this->STYLES->connection]);
        }
    }

    /**
     * Gère la demande de connexion en cours si l'utilisateur n'est pas connecté.
     * Sinon, il est redirigé à la page d'accueil.
     * @return void
     */
    public function login(){
        //Si l'utilisateur est déjà connecté...
        if ($this->isConnected()){
            //...redirection à la page d'accueil
            $this->redirectTo("");
        }
        //Sinon s'il n'est pas connecté
        else{
            //Initialisation du modèle
            require_once("../app/models/ConnectionModel.php");
            $model = new ConnectionModel();
            //Est-ce que les données envoyées correspondent à un compte utilisateur ?
            $login = $model->isLoginValid($_POST["email"], $_POST["password"]);
            //Si les données sont valides
            if ($login){
                //Regénère l'ID de session pour éviter les attaques par fixation de session
                session_regenerate_id(true);
                //Récupération des données du compte utilisateur
                $user = $model->getUser($_POST["email"]);
                //Enregistrement de cette connexion comme dernière connexion
                $model->setLastLogin($user->email, date("Y-m-d H:i:s"));
                //Enregistrement des données du compte dans la session
                $_SESSION["username"] = $user->username;
                $_SESSION["email"] = $user->email;
                $_SESSION["firstname"] = $user->firstname;
                $_SESSION["lastname"] = $user->lastname;
                $_SESSION["last_login"] = $user->last_login;
                //Redirection vers la page d'accueil
                $this->redirectTo("");
            }
            //Si les données ne sont pas valident
            else{
                //Affiche la page avec le message d'erreur
                $this->displayView($this->VIEWS->login, $this->TITLES->login, [$this->STYLES->connection], ["error" => "Identifiants incorrects."]);
            }
        }
    }

    /**
     * Gère la demande de déconnexion en cours.
     * @return void
     */
    public function logout(){
        //Si l'utilisateur est connecté
        if ($this->isConnected()){
            //Destruction de sa session
            session_unset();
            session_destroy();
        }
        //Redirection vers la page d'accueil
        $this->redirectTo("");
    }

    /**
     * Affiche la page d'inscription si l'utilisateur n'est pas connecté.
     * Sinon, il est redirigé à la page d'accueil.
     * @return void
     */
    public function pageSignin(){
        //Si il est déjà connecté...
        if ($this->isConnected()){
            //...redirection vers la page d'acceuil
            $this->redirectTo("");
        }
        //Sinon s'il n'est pas connecté...
        else{
            //Affichage de la page d'inscription
            $this->displayView($this->VIEWS->signin, $this->TITLES->signin, [$this->STYLES->connection]);
        }
    }

    /**
     * Gère la demande d'inscription en cours si l'utilisateur n'est pas connecté.
     * Sinon, il est redirigé à la page d'accueil.
     * @return void
     */
    public function signin(){
        //Si il est déjà connecté...
        if ($this->isConnected()){
            //...redirection vers la page d'acceuil
            $this->redirectTo("");
        }
        //Sinon s'il n'est pas connecté
        else{
            //Initialisation du controlleur
            require_once("../app/models/ConnectionModel.php");
            $model = new ConnectionModel();
            //Gestion des erreurs liées à aux données envoyées
            try{
                //Création du nouveau compte
                $signin = $model->addAccount($_POST["email"], $_POST["password"], $_POST["username"], $_POST["firstname"], $_POST["lastname"]);
                //Si les données étaient valides et que le compte a été créé
                if ($signin){
                    //Redirection vers la page de connexion
                    $this->redirectTo("/login");
                }
                //Si un problème est survenue
                else{
                    //Affiche la page d'inscription et avertissage de l'utilisateur
                    $this->displayView($this->VIEWS->signin, $this->TITLES->signin, [$this->STYLES->connection], ["error" => "Erreur dans la création du compte."]);
                }
            }
            //Gestion des erreurs des données
            catch(InvalidEmailException $error){ //Format de l'email invalide
                $this->displayView($this->VIEWS->signin, $this->TITLES->signin, [$this->STYLES->connection], ["error" => "Format de l'email incorrect."]);
            }
            catch(InvalidPasswordException $error){ //Format du mot de passe invalide
                $this->displayView($this->VIEWS->signin, $this->TITLES->signin, [$this->STYLES->connection], ["error" => "Le mot de passe est trop court."]);
            }
            catch(DoubleEmailException $error){ //Email déjà associé à un compte utilisateur
                $this->displayView($this->VIEWS->signin, $this->TITLES->signin, [$this->STYLES->connection], ["error" => "Email déjà utilisé."]);
            }
            catch(InvalidUsernameException $error){ //Format du pseudo invalide
                $this->displayView($this->VIEWS->signin, $this->TITLES->signin, [$this->STYLES->connection], ["error" => "Le pseudo est trop court."]);
            }
            catch(InvalidFirstNameException $error){ //Format du prénom invalide
                $this->displayView($this->VIEWS->signin, $this->TITLES->signin, [$this->STYLES->connection], ["error" => "Le prénom est trop court."]);
            }
            catch(InvalidLastNameException $error){ //Format du nom de famille invalide
                $this->displayView($this->VIEWS->signin, $this->TITLES->signin, [$this->STYLES->connection], ["error" => "Le nom de famille est trop court."]);
            }
        }
    }
}