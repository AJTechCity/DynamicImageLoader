<?php require("./functions.php");$image_id=(string) $_GET['image_id'];$scale=floatval($_GET['s']);$path=$CONFIG_DATA['DATABASE_FILE'];$db=loadJSONDatabase($path!=null?$path); ?>