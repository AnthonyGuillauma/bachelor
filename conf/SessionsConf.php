<?php
// -- Configuration des sessions clientes --

//Définition du dossier où sont stockés les fichiers de session
session_save_path("../write/sessions");

//Application des configurations de sécurité des sessions et cookies de session
session_start([
    "use_strict_mode" => true,
    "use_only_cookies" => true,
    "cookie_httponly" => true,
    "cookie_samesite" => "Strict",
    "cookie_lifetime" => 0
]);