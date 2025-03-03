<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/icon.ico" type="image/x-icon">
    <?php foreach($stylesheets as $stylesheet){
        echo("<link href=\"" . $stylesheet . "\" rel=\"stylesheet\" />");
    } ?>
    <title><?php echo($title) ?></title>
</head>