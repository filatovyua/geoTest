<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CoordsModel extends Model{
        
    private $coordsTable = "coords";
    
    public function insertRow($lat,$lon,$text){
        if (!$lat || !is_float($lat))
            throw Exception ("Lat has incorrect format");
        if (!$lon || !is_float($lon))
            throw Exception ("Lon has incorrect format ");
        if (!$text) 
            $text = "";        
        DB::table($this->coordsTable)->insert([
            "text"=>$text,
            "coordinates"=>DB::raw("POINT($lat,$lon)")
        ]);
        return true;
    }
    
    public function selectAll(){
        return DB::select("select X(coordinates) as lat, Y(coordinates) as lon, `text` from `{$this->coordsTable}` ");
    }
    
    public function selectByID($id){
        if (!(int)$id)
           throw new Exception ("undefined id"); 
        return DB::select("select X(coordinates) as lat, Y(coordinates) as lon, `text` from `{$this->coordsTable}` where ind=?",[
            $id
        ]);
    }
      
    
}