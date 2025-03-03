<body>
    <?php include_once($header);  ?>
    <section>
    <div class="connection-form">
            <form action="" method="post">
                <span>Inscription :</span>
                <input type="email" name="email" placeholder="Email"/>
                <input type="text" name="username" placeholder="Pseudo"/>
                <input type="text" name="firstname" placeholder="Prénom"/>
                <input type="text" name="lastname" placeholder="Nom de famille"/>
                <input type="password" name="password" placeholder="Mot de passe"/>
                <input type="submit" value="Se connecter"/>
                <span id="error-message">
                    <?php 
                        if (isset($datas["error"])){
                            echo($datas["error"]);
                        }
                    ?>
                </span>
            </form>
        </div>
    </section>
    <?php include_once($footer);  ?>
</body>
</html>