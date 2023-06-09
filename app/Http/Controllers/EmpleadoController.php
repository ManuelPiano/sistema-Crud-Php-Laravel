<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $datos['empleados']=Empleado::paginate(4);
        return view('empleado.index', $datos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('empleado.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $campos=[
            'nombre'=>'required|string|max:100',
            'apellidopaterno'=>'required|string|max:100',
            'apellitomaterno'=>'required|string|max:100',
            'correo'=>'required|email',
            'foto'=>'required|max:10000|mimes:jpeg,png,jpg',

        ];

        $message=[
            'required'=>'El :attribute es requerido',
            'foto.required'=>'La foto es requerida'
        ];

        $this->validate($request, $campos, $message);


        $datodeempleado = request()->except('_token');
        if($request->hasFile('foto')){
            $datodeempleado['foto']=$request->file('foto')->store('upload','public');
        }

        Empleado::insert($datodeempleado);

        //return response()->json($datodeempleado);
        return redirect('empleado')->with('message','Empleado agregado con exito');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit', compact('empleado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {

        $campos=[
            'nombre'=>'required|string|max:100',
            'apellidopaterno'=>'required|string|max:100',
            'apellitomaterno'=>'required|string|max:100',
            'correo'=>'required|email',
            

        ];

        $message=[
            'required'=>'El :attribute es requerido',
            
        ];
        if($request->hasFile('foto')){
            $campos=['foto'=>'required|max:10000|mimes:jpeg,png,jpg',];
            $message=['foto.required'=>'La foto es requerida'];

        }
        $this->validate($request, $campos, $message);
        //
        $datodeempleado = request()->except(['_token','_method']);

        if($request->hasFile('foto')){
            $empleado = Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->foto);
            $datodeempleado['foto']=$request->file('foto')->store('upload','public');
        }


        Empleado::where('id', '=',$id)->update($datodeempleado);

        

        $empleado=Empleado::findOrFail($id);
        //return view('empleado.edit', compact('empleado'));
        return redirect('empleado')->with('message','Empleado Modificado');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //

        $empleado=Empleado::findOrFail($id);

        if(Storage::delete('public/'.$empleado->foto)){
            Empleado::destroy($id);
        }
        return redirect('empleado')->with('message','Empleado Borrado');
    }
}
