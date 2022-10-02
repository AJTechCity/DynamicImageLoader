<?php

    require("./common.php");
    require("./functions.php");
    
    $preserve_state = $_GET['p'];
    
    $files = scandir($CONFIG_DATA['FOLDER_PATH']);
    $db = [];
    
    if($preserve_state == "true"){
        $old_db = loadJSONDatabase();
        $db=$old_db;
        $old_files = [];
        foreach($old_db as $file_obj){
            foreach($file_obj as $index=>$file_data){
                /*Load old files into new DB START*/
                $file_name = $file_data->file_name;
                
                $ext = pathinfo($file_name, PATHINFO_EXTENSION);
                if(in_array(strtolower($ext), $CONFIG_DATA['VALID_EXTENSIONS'])){
                    array_push($old_files, $file_name);
                }
                /*Load old files into new DB END*/
            }
        }
    }
        
        
    foreach ($files as $file){
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if(in_array(strtolower($ext), $CONFIG_DATA['VALID_EXTENSIONS'])){
            if(!in_array($file, $old_files)){
                $data = array(
                    "id"=>uuid4($CONFIG_DATA['UUID_LENGTH']),
                    "name"=>str_replace(".$ext", "", $file),
                    "file_name"=>$file,
                );
                array_push($db, [$data['id'] => $data]);
            }
        }
    }
    
    if(saveJSONDatabase($db)){
        echo 'Successfully Saved new database of images';
    }

?>