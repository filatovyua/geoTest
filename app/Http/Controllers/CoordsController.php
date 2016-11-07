<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CoordsModel as CoordsModel;
use Illuminate\Support\Facades\Input;

class CoordsController extends Controller{    
    
    
    public function get(){
        $model = new CoordsModel;
        if (Input::has("id")){
            return response()->json($model->selectByID(Input::get("id")));
        }else{
            return response()->json($model->selectAll());
        }
    } 
    
    public function put(){
        $model = new CoordsModel;          
        if (Input::has("lat") && Input::has("lon")){
            try{
                $model->insertRow(Input::get("lat"), Input::get("lon"), Input::get("text"));
            } catch (Exception $ex) {
                return responce()->json(["success"=>0,"input"=>Input::all()]);
            } 
        }else{
            return response()->json(["success"=>0]);
        }
    }
        
}
