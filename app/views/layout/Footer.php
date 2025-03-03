    <!-- PIED DE PAGE -->
    <footer>
        <?php if(!$isConnected){ ?>
            <span>Bonjour, inconnu.</span>
            <div>
                <a href="/BACHELOR_PHP_GUILLAUMA/public/index.php/login">Connexion</a>
                <a href="/BACHELOR_PHP_GUILLAUMA/public/index.php/signin">Inscription</a>
            </div>
        <?php } else{ ?>
            <span>Bonjour, <?php echo($_SESSION["username"]); ?></span>
            <form action="/BACHELOR_PHP_GUILLAUMA/public/index.php/logout" method="POST">
                <input type="submit" value="Déconnexion"/>
            </form>
        <?php } ?>
    </footer>