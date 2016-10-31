<?php
class View{
    
    public $path = "views/";
    
    public function __construct() {      
    }   
    
    public function generate($template, array $data = []){ 

        $path = $this->path . $template;

        if (!is_file($path)) {
            Route::ErrorPage404();
        } else {
            include $path;
        }       
    }
    
}