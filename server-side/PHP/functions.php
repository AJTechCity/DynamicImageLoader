<?php

    function loadJSONDatabase(string $path="php-database.json"){
        $data = json_decode(file_get_contents($path));
        if($data!=null){
            return $data
        }else{
            return false;
        }
    }

    function uuid4(int $length = 32) {
        $out = bin2hex(random_bytes(($length+4)/2));
        $out[8]  = "-";
        $out[13] = "-";
        $out[18] = "-";
        $out[23] = "-";
        $out[14] = "4";
        $out[19] = ["8", "9", "a", "b"][random_int(0, 3)];
        return $out;
    }

?>