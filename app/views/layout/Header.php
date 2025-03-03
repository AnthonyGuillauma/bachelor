    <!-- HEADER -->
    <header>
        <h1 onclick="window.location.replace('./')">Shooting stars</h1>
    </header>
    <!-- MENU NAVIGATION -->
    <a id="navigation-menu-button" onclick="changeBurgerMenuState();">≡</a>
    <nav id="navigation-menu" class="burger-menu-close">
        <span></span> 
        <a href="./news">Actualités</a> 
        <a href="./characters">Personnages</a> 
        <a href="./world">Monde</a> 
        <img id="buttonBackgroundMusic" src="./assets/icons/muted.png" onclick="changeBackgroundMusicState();"/>
    </nav>
    <!-- AUDIO -->
    <audio id="background-music" loop>
        <source src="./assets/musics/background-music-home.mp3" type="audio/mpeg">
    </audio>
    <!-- CURSEUR -->
    <div class="cursor"></div>
    <script src="<?php echo($js->menu) ?>"></script>
    <script src="<?php echo($js->music) ?>"></script>
    <script src="<?php echo($js->cursor) ?>"></script>