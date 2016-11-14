<?php

class Controller {

    private $method;
    private $vars = [];

    public function __construct($method) {
        $this->method = $method;
        $this->vars = json_decode(file_get_contents("php://input"));
    }

    public function index() {
        Factory::View()->generate("template_index.php");
    }

    public function coords() {
        if ($this->method == "GET" || $this->method == "POST") {
            Factory::View()->generate("template_responce.php", Factory::Model()->getCoords($this->vars));
        } elseif ($this->method == "PUT") {
            Factory::View()->generate("template_responce.php", Factory::Model()->putCoords($this->vars));
        } elseif ($this->method == "DELETE") {
            
        }
        return NULL;
    }

}
