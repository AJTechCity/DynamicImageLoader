<?php
    require("./functions.php");

    $image_id = (string) $_GET['image_id'];
    $scale = floatval($_GET['s']);

    //Find the image
    $path = $CONFIG_DATA['DATABASE_FILE'];
    $db = loadJSONDatabase($path!=null ? $path);

?>