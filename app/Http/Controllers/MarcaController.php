<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Caracteristica;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\UpdateMarcaRequest;
use App\Http\Requests\StoreCategoriaRequest;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $marcas = Marca::with('caracteristica')->latest()->get();
        return view('marca.index', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :View
    {
        return view('marca.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoriaRequest $request) :RedirectResponse
    {
        try{
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->marca()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();

            return redirect()->route('marcas.index')->with('success', __('messages.brands.created_success'));

        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Error creating brand: ' . $e->getMessage());
            // Redirect back with an error message
            return back()->with('error', __('messages.brands.create_error'));
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
    public function edit(Marca $marca) :view
    {
        return view('marca.edit', ['marca' => $marca]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarcaRequest $request, Marca $marca) :RedirectResponse
    {
        Caracteristica::where('id', $marca->caracteristica->id)
        ->update($request->validated());

        return redirect()->route('marcas.index')->with('success', __('messages.brands.updated_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) :RedirectResponse
    {
        $marca = Marca::find($id);

        $nuevoEstado = $marca->caracteristica->estado == 1 ? 0 : 1;

        $mensaje = $marca->caracteristica->estado == 1 
            ? __('messages.brands.deleted_success') 
            : __('messages.brands.restored_success');

        Caracteristica::where('id' , $marca->caracteristica->id)
        ->update([
            'estado' => $nuevoEstado
        ]);

        return redirect()->route('marcas.index')->with('success', $mensaje);
    }
}
