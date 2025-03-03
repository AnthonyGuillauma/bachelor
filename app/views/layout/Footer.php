    <!-- PIED DE PAGE -->
    <footer>
        <?php if(!$isConnected){ ?>
            <span>Bonjour, inconnu.</span>
            <div>
                <a href="/web/public/index.php/login">Connexion</a>
                <a href="/web/public/index.php/signin">Inscription</a>
            </div>
        <?php } else{ ?>
            <span>Bonjour, <?php echo($_SESSION["username"]); ?></span>
            <form action="/web/public/index.php/logout" method="POST">
                <input type="submit" value="Déconnexion"/>
            </form>
        <?php } ?>
    </footer>