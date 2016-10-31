<?php

class Model{
    
    public function __construct() {
    }    
    
    public function getCoords($id){
        return Factory::Connector()->connect()->get($id);
    }
    
    public function putCoords($data){
        if (!isset($data["lat"]) || !isset($data["lon"]))
            throw new Exception("Lon or Lat is not defined");
        return Factory::Connector()->connect()->put($data);
    }
}
