<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Presentacione;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() :View
    {
        $productos = Producto::with(['marca.caracteristica','categorias.caracteristica','presentacione.caracteristica'])->latest()->get();
        return view('producto.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() :View
    {
        // $marcas = Marca::whereHas('caracteristica', function ($query) {
        //     $query->where('estado', 1);
        // })->with('caracteristica')->get();

        $marcas = Marca::join('caracteristicas as c', 'marcas.caracteristica_id', '=', 'c.id')
        ->where('c.estado', 1)
        ->select('marcas.id','c.nombre')
        ->orderBy('c.nombre')
        ->get();

        $presentaciones = Presentacione::join('caracteristicas as c', 'presentaciones.caracteristica_id', '=', 'c.id')
        ->where('c.estado', 1)
        ->select('presentaciones.id', 'c.nombre')
        ->orderBy('c.nombre')
        ->get();

        $categorias = Categoria::join('caracteristicas as c', 'categorias.caracteristica_id', '=', 'c.id')
        ->where('c.estado', 1)
        ->select('categorias.*')
        ->orderBy('c.nombre')
        ->with('caracteristica')
        ->get();

        return view('producto.create',compact('marcas', 'presentaciones', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request) :RedirectResponse
    {
        try{
            DB::beginTransaction();
            // Fill producto table
            $producto = new Producto();

            if($request->hasFile('img_path')){
                $name = $producto->handleUploadImage($request->file('img_path'));
            } else {
                $name = null;
            }

            $producto->fill([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'fecha_vencimiento' => $request->fecha_vencimiento,
                'img_path' => $name,
                'marca_id' => $request->marca_id,
                'presentacione_id' => $request->presentacione_id
            ]);

            $producto->save();

            // Fill categoria_producto table
            $categorias = $request->get('categorias');
            $producto->categorias()->attach($categorias);

            DB::commit();

            return redirect()->route('productos.index')->with('success', __('messages.products.created_success'));
        }catch(\Exception $e){
            DB::rollBack();
            Log::error('Error creating product: ' . $e->getMessage());
            // Redirect back with an error message
            return back()->with('error', __('messages.products.create_error'));
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
    public function edit(Producto $producto) :View
    {
        $marcas = Marca::join('caracteristicas as c', 'marcas.caracteristica_id', '=', 'c.id')
        ->where('c.estado', 1)
        ->select('marcas.id','c.nombre')
        ->orderBy('c.nombre')
        ->get();

        $presentaciones = Presentacione::join('caracteristicas as c', 'presentaciones.caracteristica_id', '=', 'c.id')
        ->where('c.estado', 1)
        ->select('presentaciones.id', 'c.nombre')
        ->orderBy('c.nombre')
        ->get();

        $categorias = Categoria::join('caracteristicas as c', 'categorias.caracteristica_id', '=', 'c.id')
        ->where('c.estado', 1)
        ->select('categorias.id', 'c.nombre')
        ->orderBy('c.nombre')
        ->get();

        return view('producto.edit', compact('producto','marcas','presentaciones','categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Producto $producto) :RedirectResponse
    {
        try {
            DB::beginTransaction();

            if($request->hasFile('img_path')){
                $name = $producto->handleUploadImage($request->file('img_path'));
                // Eliminar imagen antigua
                if(Storage::disk('public')->exists('/productos/'.$producto->img_path)){
                    Storage::disk('public')->delete('/productos/'.$producto->img_path);
                }
            } else {
                $name = $producto->img_path;
            }

            $producto->fill([
                'codigo' => $request->codigo,
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'fecha_vencimiento' => $request->fecha_vencimiento,
                'img_path' => $name,
                'marca_id' => $request->marca_id,
                'presentacione_id' => $request->presentacione_id
            ]);

            $producto->save();

            // Fill categoria_producto table
            $categorias = $request->get('categorias');
            $producto->categorias()->sync($categorias);

            DB::commit();

            return redirect()->route('productos.index')->with('success', __('messages.products.created_success'));
        } catch (\Exception $e){
            DB::rollBack();
            Log::error('Error updating product: ' . $e->getMessage());
            // Redirect back with an error message
            return back()->with('error', __('messages.products.updated_error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $producto = Producto::find($id);

        $nuevoEstado = $producto->estado == 1 ? 0 : 1;

        $mensaje = $producto->estado == 1 
            ? __('messages.products.deleted_success') 
            : __('messages.products.restored_success');

        Producto::where('id' , $producto->id)
        ->update([
            'estado' => $nuevoEstado
        ]);

        return redirect()->route('productos.index')->with('success', $mensaje);
    }
}
