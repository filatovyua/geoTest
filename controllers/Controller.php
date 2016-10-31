<?php

class Controller {

    private $method;
    private $vars = [];

    public function __construct($method) {
        $this->method = $method;
        $this->filter($_REQUEST);
        $this->vars = &$_REQUEST;
    }

    private function filter(&$data) {
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $this->filter($data[$key]);
            }
        } else {
            $data = strip_tags($data);
            $data = preg_replace("/(INSERT|SELECT|EXEC|UPDATE|DROP|TRUNCATE|DELETE|CREATE|USE|DESCRIBE|TABLE)/i", "", $data);
            $data = htmlspecialchars($data);
        }
    }

    public function index() {
        Factory::View()->generate("template_index.php");
    }

    public function coords() {
        if ($this->method == "GET" || $this->method == "POST") {
            Factory::View()->generate("template_responce.php", Factory::Model()->getCoords($this->vars["id"]));
        } elseif ($this->method == "PUT") {
            Factory::View()->generate("template_responce.php", Factory::Model()->putCoords($this->vars));
        } elseif ($this->method == "DELETE") {
            
        }
        return NULL;
    }

}
