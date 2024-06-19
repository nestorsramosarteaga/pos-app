<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Caracteristica;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreCategoriaRequest;
use App\Http\Requests\UpdateCategoriaRequest;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $categorias = Categoria::with('caracteristica')->latest()->get();
        return view('categoria.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :View
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request) :RedirectResponse
    {
        try{
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->categoria()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();

            return redirect()->route('categorias.index')->with('success', __('messages.categories.created_success'));
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Error creating category: ' . $e->getMessage());
            // Redirect back with an error message
            return back()->with('error', __('messages.category.create_error'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria) :View
    {
        return view('categoria.edit', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoriaRequest $request, Categoria $categoria) :RedirectResponse
    {
        try{
            DB::beginTransaction();
            Caracteristica::where('id', $categoria->caracteristica->id)
                ->update($request->validated());
            DB::commit();

            return redirect()->route('categorias.index')->with('success', __('messages.categories.updated_success'));
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Error updating category: ' . $e->getMessage());
            // Redirect back with an error message
            return back()->with('error', __('messages.categories.updated_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) :RedirectResponse
    {
        $categoria = Categoria::find($id);

        $nuevoEstado = $categoria->caracteristica->estado == 1 ? 0 : 1;

        $mensaje = $categoria->caracteristica->estado == 1 
            ? __('messages.categories.deleted_success') 
            : __('messages.categories.restored_success');

        Caracteristica::where('id' , $categoria->caracteristica->id)
        ->update([
            'estado' => $nuevoEstado
        ]);

        return redirect()->route('categorias.index')->with('success', $mensaje );
    }
}
