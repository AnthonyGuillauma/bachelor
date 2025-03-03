<body>
    <?php include_once($header); ?>
    <!-- LOGO -->
    <img id="logo" src="assets/logo.png"/>
    <!-- CONTENT -->
     <section>
        <video id="main_video_home" src="./assets/fe_home.mp4" autoplay muted loop></video>
        <span id="main_text_home">
            <?php if ($isConnected){
                echo("Que les étoiles vous guident, " . $_SESSION["firstname"] . " " . $_SESSION["lastname"] . "...");
            }
            else{
                echo("Débutez votre aventure");
            } ?>
            
        </span>
    </section>
    <?php include_once($footer); ?>
</body>
</html>