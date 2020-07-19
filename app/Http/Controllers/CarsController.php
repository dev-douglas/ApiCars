<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use Illuminate\Support\Facades\Validator;

class CarsController extends Controller
{
    private $model;


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Cars $cars)
    {
        $this->model = $cars;
    }

    public function getAll(){
        $cars = $this->model->all();

        return response()->json($cars);
    }

    public function get($id){
        $car = $this->model->find($id);
        return response()->json($car);
    }

    public function store(Request $request){

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required | max:5',
                'model' => 'required | max: 10 | min: 2',
                'date' => 'required | date_format: "Y-m-d"'
            ]
        );
        
        if($validator->fails()){
            return response()->json($validator->errors());
        }else{
            try {
                $car = $this->model->create($request->all());//tem como retorno o array do registro inserido
                return response()->json($car);
            } catch (QueryException $exception){
                return response()->json(['error' => "Erro inesperado"]);
            }
        }
        
    }

    public function update($id, Request $request){
        $car = $this->model->find($id)->update($request->all());
        return response()->json($car);
    }

    public function destroy($id){
        $car = $this->model->find($id)->delete();

        return response()->json($car);
    }
}
