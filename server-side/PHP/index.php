<?php
    require("./functions.php");

    $image_id = strval($_GET['image_id']);
    $scale = floatval($_GET['s']);
    $mode = $_GET['m'];
    if($scale==0){
        $scale=1;
    }
    $valid_modes = ["IMG_NEAREST_NEIGHBOUR"=>16, "IMG_BILINEAR_FIXED"=>3, "IMG_BICUBIC"=>4, "IMG_BICUBIC_FIXED"=>5];
    if(!in_array($mode, $valid_modes)){
        $mode = IMG_BICUBIC;
    }

    //Find the image
    $db_path = $CONFIG_DATA['DATABASE_FILE'];
    $db;
    if($db_path!=null){
        $db = loadJSONDatabase($db_path);
    }else{
        $db = loadJSONDatabase();
    }
    $image_data = $db->$image_id;
    if($image_data){
        $image_file_name = $image_data->file_name;
        $image_path = $CONFIG_DATA['BASE_URI']."/".$image_file_name;
        $image_relative_path = "./images/".$image_file_name;
        $extension = strtolower(pathinfo($image_file_name, PATHINFO_EXTENSION));
        $img;
        $img_string = file_get_contents($image_relative_path);
        $img = imagecreatefromstring($img_string);
        if($img){
            header('Content-Type: image/png');
            $width  = imagesx($img);
            $height  = imagesy($img);
            $new_width = $width*$scale;
            $new_height = $height*$scale;
            $img = imagescale($img, $new_width, $new_height, $mode);
            switch($extension){
                case "jpg":
                    imagejpeg($img);
                    break;
                case "jpeg":
                    imagejpeg($img);
                    break;
                case "png":
                    imagepng($img);
                    break;
            }
            imagedestroy($img);
            exit;
        }else{
            header("Content-type:application/json");
            new Returns().error(500, "Error processing Image");
            exit;
        }

    }else{
        new Returns.error(404, "Image not found");
        exit;
    }

    //echo $image_path;
?>