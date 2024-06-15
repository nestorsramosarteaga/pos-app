<?php

namespace App\Http\Controllers;

use App\Models\Presentacione;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Caracteristica;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePresentacionRequest;
use App\Http\Requests\UpdatePresentacionRequest;

class PresentacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $presentaciones = Presentacione::with('caracteristica')->latest()->get();
        return view('presentacione.index', ['presentaciones' => $presentaciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :View
    {
        return view('presentacione.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresentacionRequest $request) :RedirectResponse
    {
        try{
            DB::beginTransaction();
            $caracteristica = Caracteristica::create($request->validated());
            $caracteristica->presentacione()->create([
                'caracteristica_id' => $caracteristica->id
            ]);
            DB::commit();

            return redirect()->route('presentaciones.index')->with('success', __('messages.presentations.created_success'));

        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Error creating brand: ' . $e->getMessage());
            // Redirect back with an error message
            return back()->with('error', __('messages.presentations.create_error'));
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
    public function edit(Presentacione $presentacione) :view
    {
        return view('presentacione.edit', ['presentacione' => $presentacione]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresentacionRequest $request, Presentacione $presentacione) :RedirectResponse
    {
        Caracteristica::where('id', $presentacione->caracteristica->id)
        ->update($request->validated());

        return redirect()->route('presentaciones.index')->with('success', __('messages.presentations.updated_success'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) :RedirectResponse
    {
        $presentacione = Presentacione::find($id);

        $nuevoEstado = $presentacione->caracteristica->estado == 1 ? 0 : 1;

        $mensaje = $presentacione->caracteristica->estado == 1 
            ? __('messages.presentations.deleted_success') 
            : __('messages.presentations.restored_success');

        Caracteristica::where('id' , $presentacione->caracteristica->id)
        ->update([
            'estado' => $nuevoEstado
        ]);

        return redirect()->route('presentaciones.index')->with('success', $mensaje);
    }
}
