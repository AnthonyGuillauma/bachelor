<?php

// -- Configuration des chemins et noms des pages --
//(pour ne pas avoir à les répéter à chaque fois + meilleure maintenabilité)

/** @var string Racine des fichiers des vues */
$viewBasePath = "../app/views";
/** @var string Racine des fichiers css */
$styleBasePath = "style";
/** @var string Racine des fichiers javascript */
$jsBasePath = "js";

/** @var object Chemins des fichiers */
$paths = (object) array(
    "views" => (object) array( // Fichiers des vues
        "login" => "$viewBasePath/LoginView.php",
        "signin" => "$viewBasePath/SigninView.php",
        "home" => "$viewBasePath/HomeView.php",
        "characters" => "$viewBasePath/CharactersView.php",
        "world" => "$viewBasePath/WorldView.php",
        "news" => "$viewBasePath/NewsView.php",
        "head" => "$viewBasePath/layout/Head.php",
        "header" => "$viewBasePath/layout/Header.php",
        "footer" => "$viewBasePath/layout/Footer.php"
    ),
    "styles" => (object) array( // Fichiers css
        "main" => "$styleBasePath/Main.css",
        "connection" => "$styleBasePath/Connection.css",
        "home" => "$styleBasePath/Home.css",
        "header" => "$styleBasePath/Header.css",
        "footer" => "$styleBasePath/Footer.css",
        "characters" => "$styleBasePath/Characters.css",
        "world" => "$styleBasePath/World.css",
        "news" => "$styleBasePath/News.css"
    ),
    "js" => (object) array( // Fichiers javascript
        "cursor" => "$jsBasePath/Cursor.js",
        "menu" => "$jsBasePath/Menu.js",
        "music" => "$jsBasePath/Music.js",
        "characters" => "$jsBasePath/Characters.js",
        "world" => "$jsBasePath/World.js",
        "news" => "$jsBasePath/News.js"
    )
);

/** @var object Nom des pages */
$names = (object) array(
    "login" => "Connexion",
    "signin" => "Inscription",
    "home" => "Shooting stars",
    "characters" => "Personnages",
    "world" => "Monde",
    "news" => "Actualités"
);