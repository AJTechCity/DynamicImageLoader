<?php

    require("./functions.php");

    $image_id = $_GET['image_id'];
    $width = $_GET['w'];
    $height = $_GET['h'];
    $quality = $_GET['q'];

    $CONFIG_DATA = array(
        "BASE_URI"=>"https://images.example.com" //Base URI where all your iamges are located,
        "UUID_LENGTH"=>32 //Length of the UUID generated for each image
    );


?>