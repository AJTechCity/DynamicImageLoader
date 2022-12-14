<?php

    class Returns{
        public function success(int $status_code, string $description, array $data=null){
            http_response_code($status_code);
            print_r(json_encode(array(
                "status"=>"success",
                "status_code"=>$status_code,
                "description"=>$description,
                "data"=>$data
            )));
        }

        public function error(int $status_code, string $description, array $data=null){
            http_response_code($status_code);
            print_r(json_encode(array(
                "status"=>"error",
                "status_code"=>$status_code,
                "description"=>$description,
                "data"=>$data
            )));
        }
    }

?>