    <!-- HEADER -->
    <header>
        <h1 onclick="window.location.replace('/web/public/index.php')">Shooting stars</h1>
    </header>
    <!-- MENU NAVIGATION -->
    <a id="navigation-menu-button" onclick="changeBurgerMenuState();">≡</a>
    <nav id="navigation-menu" class="burger-menu-close">
        <span></span> 
        <a href="/web/public/index.php/news">Actualités</a> 
        <a href="/web/public/index.php/characters">Personnages</a> 
        <a href="/web/public/index.php/world">Monde</a> 
        <img id="buttonBackgroundMusic" src="assets/icons/muted.png" onclick="changeBackgroundMusicState();"/>
    </nav>
    <!-- AUDIO -->
    <audio id="background-music" loop>
        <source src="assets/musics/background-music-home.mp3" type="audio/mpeg">
    </audio>
    <!-- CURSEUR -->
    <div class="cursor"></div>
    <script src="<?php echo($js->menu) ?>"></script>
    <script src="<?php echo($js->music) ?>"></script>
    <script src="<?php echo($js->cursor) ?>"></script>