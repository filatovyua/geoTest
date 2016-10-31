<?php

class Connector {

    protected $system_password;
    protected $system_user = "root";
    protected $db = "main";
    protected $table = "coords";
    protected $host = "localhost";

    private $link = null;

    public function __construct() {
        
    }

    public function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset=UTF8";
        try {
            $this->link = new PDO($dsn, $this->system_user, $this->system_password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (Exception $ex) {
            throw new Exception("Connection lost: $dsn :".$ex->getMessage());
        }
        return $this;
    }
    
    public function query($sql){
        if (!$sql)
            return NULL;        
        return $this->link->query($sql);
    }
    
    public function get($id){
        $wh = "";
        if ($id)
            $wh .= " WHERE ind=$id ";
        return $this->fetchArray($this->query("SELECT X(coordinates) as lat, Y(coordinates) as lon, `text` FROM {$this->db}.{$this->table} $wh"));
    }
    
    public function put($data){
        return $this->query("INSERT INTO {$this->db}.{$this->table} (`text`,`coordinates`)"
        . " VALUES ('{$data['text']}',POINT({$data['lat']},{$data["lon"]})) ") !== false;
    }
    
    public function fetch($resouce){
        return $resouce->fetch();
    }
    public function fetchArray($resource){
        while ($s = $this->fetch($resource)){
            $result[] = $s;
        }
        return $result;
    }

}
