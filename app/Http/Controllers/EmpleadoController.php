<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(1);
        return view('empleado.index',$datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $campos=[
             'Nombre'=>'required|string|max:100',
             'ApellidoPaterno'=>'required|string|max:100',
             'ApellidoMaterno'=>'required|string|max:100',
             'Correo'=>'required|email',
             'Foto'=>'required|max:10000|mimes:jpeg,png,jpg',

         ];
         $mensaje=[
             'required'=>'El :attribute es requerido',
             'Foto.required'=>'La Foto requerida'
         ];

         $this->validate($request,$campos,$mensaje);

        // $datosEmpleado = request()->all();
        $datosEmpleado = request()->except('_token'); // recolectar datos menos token

        if($request->hasFile('Foto')){
            $datosEmpleado['Foto']= $request->file('Foto')->store('uploads','public');
        }

        Empleado::insert($datosEmpleado); // inserta al base de datos

       // return response()->json($datosEmpleado);  // para retornar todas los datos del empleado
       return redirect('empleado')->with('mensaje','Empleado Agregado con exito');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrfail($id);
        return view('empleado.edit',compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $campos=[
            'Nombre'=>'required|string|max:100',
            'ApellidoPaterno'=>'required|string|max:100',
            'ApellidoMaterno'=>'required|string|max:100',
            'Correo'=>'required|email',

        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        
        ];
        if($request->hasFile('Foto')){
            $campos=[ 'Foto'=>'required|max:10000|mimes:jpeg,png,jpg' ];
            $mensaje=[  'Foto.required'=>'La Foto requerida' ];
        }
        $this->validate($request,$campos,$mensaje);


        $datosEmpleado = request()->except(['_token','_method']);

        if($request->hasFile('Foto')){
            $empleado=Empleado::findOrfail($id);

            Storage::delete('public/'.$empleado->Foto);
            $datosEmpleado['Foto']= $request->file('Foto')->store('uploads','public');
        }

        Empleado::where('id','=',$id)->update($datosEmpleado);

        $empleado=Empleado::findOrfail($id);
       // return view('empleado.edit',compact('empleado'));
       return redirect('empleado')->with('mensaje','Empleado Modificado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $empleado=Empleado::findOrfail($id);
       
         if(Storage::delete('public/'.$empleado->Foto)){
             Empleado::destroy($id);
         }

        return redirect('empleado')->with('mensaje','Empleado Eliminado con exito');
    }
}
