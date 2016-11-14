<?php

class Model{
    
    public function __construct() {
    }    
    
    public function getCoords($id){
        return Factory::Connector()->connect()->get($id);
    }
    
    public function putCoords($data){
        if (!is_array($data))
            throw new Exception("data is not Array");
        foreach ($data as $value) {
            if (Factory::Connector()->connect()->put($value->lon, $value->lat, $value->text) == FALSE)
                throw new Exception("Error put data");
        }
        return [
            "success"=>1
        ];
    }
}
