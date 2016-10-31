<?php

class Factory{
    public static function Connector(){
        return new Connector();
    }
    
    public static function Controller($method){
        return new Controller($method);
    }
    
    public static function Model(){
        return new Model();
    }
    public static function View(){
        return new View();
    }
}

