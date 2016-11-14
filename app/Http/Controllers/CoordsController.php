<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoordsModel as CoordsModel;
use Illuminate\Support\Facades\Input;

class CoordsController extends Controller{    
    
    
    public function post(){
        $model = new CoordsModel;
        $content = json_decode(file_get_contents("php://input"));
        if (isset($content->id)){
            return response()->json($model->selectByID($content->id));
        }else{
            return response()->json($model->selectAll());
        }
    } 
    
    public function put(){
        $model = new CoordsModel;   
        $content = json_decode(file_get_contents("php://input"));
        try {
            foreach ($content as $row){
                $model->insertRow($row->lat, $row->lon, $row->text);
            }
        } catch (Exception $ex) {
            return json_encode(["success"=>0,"message"=>$ex->getMessage()]);
        }
        return json_encode(["success"=>1]);
    }
        
}
