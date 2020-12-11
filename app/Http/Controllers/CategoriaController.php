<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    const PAGINACION =10;
    public function index(Request $request)
    {
        $buscarpor = $request->get('buscarpor');
        // return $request->all();
        $categoria = Categoria::where('estado','=','1')
        ->where('descripcion','like','%'.$buscarpor.'%')->paginate($this::PAGINACION);
        return view('tablas.categorias.index',compact('categoria','buscarpor'));

        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tablas.categorias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request() -> validate([
            'descripcion' => 'required|max:30'
        ],
        [
            'descripcion.required' => 'Ingrese descripcion de categoria',
            'descripcion.max' => 'Maximo 30 caracteres para descripcion'
        ]);
        $categoria = new Categoria();
        $categoria -> descripcion = $request -> descripcion;
        $categoria -> estado = '1';
        $categoria -> save();
        return redirect() -> route('categoria.index') -> with('datos','Registro Nuevo Guardado!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoria=Categoria::findOrFail($id);
        return view('tablas.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = request() -> validate([
            'descripcion' => 'required|max:30'
        ],
        [
            'descripcion.required' => 'Ingrese descripcion de categoria',
            'descripcion.max' => 'Maximo 30 caracteres para descripcion'
        ]);
        $categoria=Categoria::findOrFail($id);
        $categoria -> descripcion = $request -> descripcion;
        $categoria -> save();
        return redirect() -> route('categoria.index') -> with('datos','Registro Actualizado!!');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->estado='0';
        $categoria->save();
        return redirect()->route('categoria.index')->with('datos','Registro Eliminado..!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function confirmar($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('tablas.categorias.confirmar', compact('categoria'));
    }
}
