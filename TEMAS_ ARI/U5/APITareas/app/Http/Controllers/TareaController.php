<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class TareaController extends Controller{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        //Recuperar todas las tareas
        try {
            $tarea= Tarea::all();
            return $tarea;
        } catch (\Throwable $th) {
            return response()-> json('Error:'.$th->getMessage(),500);
        }
    }






    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        //Crear tarea
        //Validar datos
        $request->validate(
            [
                'fecha'=>'required',
                'hora'=>'required',
                'descripcion'=>'required',
                'prioridad'=>'in:Alta,Media,Baja'   //SOLO DEJA PONER ESOS VALORES
            ]
        );

        try {
            //Crear un objeto tarea
            $t = new Tarea();
            if(isset($request->prioridad)){
                $t->prioridad = $request->prioridad;
            }
            $t->fecha = $request->fecha;
            $t->hora = $request->hora;
            $t->descripcion = $request->descripcion;

            if($t->save()){
                return response()->json(['mensaje'=>'Tarea creada','tarea'=>$t],201);
            }else{
                return response()->json('Error: No se ha creado la tarea ',500);
            }
        } catch (\Throwable $th) {
            return response()->json('Error'.$th->getMessage(),500);
        }
    }






    /**
     * Display the specified resource.
     */
    public function show(Tarea $tarea) {
        //Monstrar una tarea

        try {
            return $tarea;
        } catch (\Throwable $th) {
            return response()->json('Error'.$th->getMessage(),500);
        }
    }






    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tarea $tarea)
    {
        //
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tarea $tarea)
    {
        //
    }
}
