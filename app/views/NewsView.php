<body>
    <?php include_once($header) ?>
    <section>
        <div id="articles">
            <div id="list-articles">
                <?php 
                    foreach ($datas["news"] as $news){
                        echo("<div id='button-news-" . $news->id . "' class='button-article' onclick='openNews(" . $news->id .");'>" 
                        . "<span>". $news->title . "</span>"
                        . "<small>". $news->author . "</small>"
                        . "<small>". $news->date . "</small>"
                        . "</div>");
                    }
                ?>
            </div>
            <div id="article-display">
                <?php 
                    foreach ($datas["news"] as $news){
                        echo("<article id='news-" . $news->id . "' class='article article-closed'>" . $news->content . "</article>");
                    }
                ?>
            </div>
    </section>
    <?php include_once($footer); ?>
    <script src="<?php echo($js->news) ?>"></script>
    <script><?php echo("openNews(" . $datas["news"][0]->id . ");" ); ?></script>
</body>
</html>