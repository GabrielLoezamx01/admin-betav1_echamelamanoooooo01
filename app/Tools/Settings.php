<?php
namespace App\Tools;

class Settings {
    static function validate_auto(array $request) {
        $array = [];
        $data  = [];
        foreach ($request as $key => $item){
            $array = [
                $key => 'required'
            ];
            $data = array_merge($array,$data);
        }
        return $data;
    }

}
