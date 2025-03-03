<body>
    <?php include_once($header) ?>
    <section>
        <div id="characters-part">
            <div id="container-characters-places">      
                <!-- <span id="title-character">Personnages</span> -->
                <?php 
                    foreach ($datas["origins"] as $id => $information){
                        echo("<div class='origin' style='order:" . $information["display_order"] . ";' onclick=\"changeOrigin('$id');\"><img class='logo-origin' src='../assets/images/places_of_origin_logos/" . $id . ".png'/><span>" . $information["name"] ."</span></div>");
                    }
                ?>
            </div>
            <div id="container-characters">
                <div id="character-information">
                    <img id="character-information-splash-art" src=""/>
                    <span id="character-information-name">Nom du personnage</span>
                    <img id="button-character-information-voice" src="assets/icons/sound.png" onclick="playCurrentCharacterVoice();"/>
                    <span id="character-information-voice">Voix : </span>
                </div>
                <div id="list-characters">
                    <?php 
                        foreach($datas["characters"] as $id => $character){
                            echo("<div id=\"character-$id\" class=\"character\" onclick=\"openCharacter('$id');\">" . "<img src=\"../assets/images/characters_splash_arts/banniere$id.jpg\"/></div>");
                        }
                    ?>
                </div>
                <span id="button-next-character" onclick="nextCharacter();">-></span>
            </div>
        </div>
        <audio id="character-voice-audio">
            <source src="" type="audio/mpeg">
        </audio>
    </section>
    <?php include_once($footer) ?>
    <script>
        const characters = <?php echo(json_encode($datas["characters"])); ?>;
        const origins = <?php echo(json_encode($datas["origins"])); ?>;
    </script>
    <script src="<?php echo($js->characters) ?>"></script>
</body>
</html>