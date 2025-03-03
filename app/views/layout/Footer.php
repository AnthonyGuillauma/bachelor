    <!-- PIED DE PAGE -->
    <footer>
        <?php if(!$isConnected){ ?>
            <span>Bonjour, inconnu.</span>
            <div>
                <a href="./login">Connexion</a>
                <a href="./signin">Inscription</a>
            </div>
        <?php } else{ ?>
            <span>Bonjour, <?php echo($_SESSION["username"]); ?></span>
            <form action="./logout" method="POST">
                <input type="submit" value="Déconnexion"/>
            </form>
        <?php } ?>
    </footer>