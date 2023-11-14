<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Queja;
use App\Models\User;
use App\Models\Respuesta;

class QuejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $quejas = Queja::join('users', 'quejas.id_usuario', '=', 'users.id')
                      ->selectRaw('quejas.*, users.email as email_usuario, DATE(quejas.created_at) as fecha_sin_hora')
                      ->get();

      return view('sistema.ListaQuejas', compact('quejas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      $id_usuario = auth()->user()->id;
      return view('sistema.QuejaNuevo', compact('id_usuario'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $validacion = $request->validate([
        'tipo' => 'required',
        'descripcion' => 'required'
      ]);

      $queja = new Queja();

      $queja->tipo = $request->input('tipo');
      $queja->descripcion = $request->input('descripcion');
      $queja->estado = 1;
      $queja->id_usuario = $request->input('id_usuario');

      $queja->save();
      
      
      return back()->with('message', 'Creado Correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      $queja = Queja::find($id);

      return view('sistema.QuejaSeguimiento', compact('queja'));
    }

    public function seguimiento(string $id)
    {
      
      $queja = Queja::find($id);

      return view('sistema.QuejaSeguimiento', compact('queja'));

      
    }

    public function guardarSeguimiento(Request $request)
    {
      $validacion = $request->validate([
        'respuesta' => 'required'
      ]);

      $respuesta = new Respuesta();

      $respuesta->respuesta = $request->input('respuesta');
      $respuesta->id_queja = $request->input('id');

      $respuesta->save();
      
      $queja = Queja::find($request->input('id'));
      $queja->estado = 2;
      $queja->save();

      
      return back()->with('message', 'Creado Correctamente');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
      
      $queja = Queja::find($id);
      $estado = $queja->estado;
      if($estado == 2){

        $respuesta = Respuesta::where('id_queja', $id)->first();
        $queja->respuesta_queja = $respuesta->respuesta;
        return view('sistema.QuejaEditar', compact('queja'));
      }else{
        $queja->respuesta_queja = '';
      }
      return view('sistema.QuejaEditar', compact('queja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
      // $validacion = $request->validate([
      //   'tipo' => 'required',
      //   'descripcion' => 'required'
      // ]);

      // $queja = Queja::find($id);

      // $queja->tipo = $request->input('tipo');
      // $queja->descripcion = $request->input('descripcion');
      // $queja->estado = 1;
      // $queja->id_usuario = 1;

      // $queja->save();
      
      
      // return back()->with('message', 'Actualizado Correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
      
      $queja = Queja::find($id);
      $queja->delete();

      return back();
    }


}
