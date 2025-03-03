<body>
    <?php include_once($header) ?>
    <section>
        <div id="introduction">
            <div id="introduction-world">
                <span id="introduction-world-name">Stern</span>
                <div id="introduction-world-description">
                    Bienvenue à Stern — un monde où la nuit est plus longue que le jour,
                    et où les étoiles sont notre meilleurs alliés.<br/>
                    Stern est un monde fantasy-médiéval dans lequel la magie reigne depuis des siècles.<br/>
                    Ici, l'imaginaire transperce le ciel et tente de traverser l'univers, bien qu'il soit infini...<br/>
                    Laissez vous guider par le ciel et venez découvrir ce monde fabuleux !
                </div>
            </div>
        </div>
        <div id="world-presentation">
            <span id="button-close-world-presentation">X</span>
            <div>Dans ce monde,</div>
            <div>ce trouve...</div>
            <div id="world-particularities">
                <div id="story-world" class="world-particularity" onclick="openWorldParticularity('story');">
                    <span class="world-particularity-name">Une histoire</span>
                    <div id="story-world-presentation" class="world-particularity-presentation">
                        <h1>L'histoire</h1>
                    </div>
                </div>
                <div id="landscapes-world" class="world-particularity world-particularity-right" onclick="openWorldParticularity('landscapes');">
                    <span class="world-particularity-name">Des paysages fabuleux</span>
                    <div id="landscapes-world-presentation" class="world-particularity-presentation">
                        <img id="world-map" src="assets/images/map.png" />
                    </div>
                </div>
                <div id="civilizations-world" class="world-particularity" onclick="openWorldParticularity('civilizations');">
                    <span class="world-particularity-name">Des civilisations</span>
                    <div id="civilizations-world-presentation" class="world-particularity-presentation">
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php include_once($footer) ?>
    <script src="<?php echo($js->world) ?>"></script>
</body>
</html>