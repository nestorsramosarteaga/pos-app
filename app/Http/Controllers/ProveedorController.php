<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Documento;
use App\Models\Proveedore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StorePersonaRequest;
use App\Http\Requests\UpdateProveedorRequest;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedores = Proveedore::with('persona.documento')->get();
        return view('proveedor.index', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $documentos = Documento::all();
        return view('proveedor.create', compact('documentos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonaRequest $request)
    {
        try {
            DB::beginTransaction();
            $persona = Persona::create($request->validated());
            $persona->proveedore()->create([
                'persona_id' => $persona->id
            ]);

            DB::commit();
        } catch (\Exception $e) {
            Log::error('Error creating supplier: ' . $e->getMessage());
            // Redirect back with an error message
            return back()->with('error', __('messages.suppliers.create_error'));
        }

        return redirect()->route('proveedores.index')->with('success', __('messages.suppliers.created_success'));
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
    public function edit(Proveedore $proveedore)
    {
        $proveedore->load('persona.documento');
        $documentos = Documento::all();
        return view('proveedor.edit', compact('proveedore','documentos'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProveedorRequest $request, Proveedore $proveedore)
    {
        try {
            DB::beginTransaction();

            Persona::where('id', $proveedore->persona->id)
                ->update($request->validated());

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating supplier: ' . $e->getMessage());
            // Redirect back with an error message
            return back()->with('error', __('messages.suppliers.updated_error'));
        }

        return redirect()->route('proveedores.index')->with('success', __('messages.suppliers.updated_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $persona = Persona::find($id);
        $nuevoEstado = $persona->estado == 1 ? 0 : 1;

        $mensaje = $persona->estado == 1
            ? __('messages.suppliers.deleted_success')
            : __('messages.suppliers.restored_success');

        Persona::where('id' , $persona->id)
        ->update([
            'estado' => $nuevoEstado
        ]);

        return redirect()->route('proveedores.index')->with('success', $mensaje );
    }
}
