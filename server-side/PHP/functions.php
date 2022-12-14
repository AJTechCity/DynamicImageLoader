<?php

    require("./common.php");

    function loadJSONDatabase(string $path="php-image-database.json"){
        $data = json_decode(file_get_contents($path));
        if($data!=null){
            return $data;
        }else{
            new Returns().error(400, "Invalid JSON has been stored");
        }
    }

    function saveJSONDatabase(array $data, string $path="php-image-database.json"){
        $data = json_encode($data, JSON_PRETTY_PRINT);
        if($data!=null){
            file_put_contents($path, $data);
            return true;
        }else{
            new Returns().error(400, "Invalid JSON data has been supplied");
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
    
    function relativePath($from, $to, $separator = DIRECTORY_SEPARATOR){
        $from   = str_replace(array('/', '\\'), $separator, $from);
        $to     = str_replace(array('/', '\\'), $separator, $to);
    
        $arFrom = explode($separator, rtrim($from, $separator));
        $arTo = explode($separator, rtrim($to, $separator));
        while(count($arFrom) && count($arTo) && ($arFrom[0] == $arTo[0]))
        {
            array_shift($arFrom);
            array_shift($arTo);
        }
    
        return str_pad("", count($arFrom) * 3, '..'.$separator).implode($separator, $arTo);
    }

?>