<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Catalogue;
use App\Models\Categoria;
use Illuminate\Http\Request;

class CatalogueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.catalogos.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Categoria::all();
        return view('panel.catalogos.create', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required'
        ]);

        $catalogo = Catalogue::create($request->all());

        if ($request->categorias) {
            $catalogo->categorias()->attach($request->categorias);
        }

        return redirect()->route('panel.catalogues.index')->with('info', 'El catálogo se creó con éxito');


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
    public function edit(Catalogue $catalogue)
    {
        $categorias = Categoria::all();
        return view('panel.catalogos.edit', compact('catalogue', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Catalogue $catalogue)
    {
        $request->validate([
            'nombre'=>'required'
        ]);
        $catalogue->update($request->all());
        $catalogue->categorias()->sync($request->categorias);
        return redirect()->route('panel.catalogues.index')->with('info','Catálogo editado correctamente');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catalogue $catalogue)
    {
        $catalogue->delete();

        return redirect()->route('panel.catalogues.index')->with('info','El catálogo se eliminó con éxito');

    }
}
