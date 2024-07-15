<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Proveedore;
use App\Models\Comprobante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\StoreCompraRequest;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::with('comprobante','proveedore.persona')
        ->where('estado', 1)
        ->latest()
        ->get();

        return view('compra.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedores = Proveedore::whereHas('persona', function ($query) {
            $query->where('estado', 1);
        })->get();

        $comprobantes = Comprobante::all();
        $productos = Producto::active();

        return view('compra.create', compact('proveedores','comprobantes','productos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompraRequest $request)
    {
        try{
            DB::beginTransaction();

            // Create purchase
            $compra = Compra::create($request->validated());

            // Fill compra_producto table
            // 1. Get arrays
            $arrayProductoId = $request->get('arrayproductoid');
            $arrayQuantity =  $request->get('arrayquantity');
            $arrayPurchasePrice = $request->get('arraypurchaseprice');
            $arraySellingPrice = $request->get('arraysellingprice');

            // 2. Make the filled
            $sizeArray =  count($arrayProductoId);
            $count = 0;

            while($count < $sizeArray){
                //dd($compra, $count, $sizeArray, $arrayProductoId[$count], $arrayQuantity[$count], $arrayPurchasePrice[$count],$arraySellingPrice[$count]);
                $compra->productos()->syncWithoutDetaching([
                    $arrayProductoId[$count] => [
                        'cantidad' => $arrayQuantity[$count],
                        'precio_compra' => $arrayPurchasePrice[$count],
                        'precio_venta' => $arraySellingPrice[$count],
                    ]
                ]);

                // 3. Update stock
                $producto = Producto::find($arrayProductoId[$count]);
                $currentStock = $producto->stock;
                $newStock = intval($arrayQuantity[$count]);

                DB::table('productos')
                ->where('id', $producto->id)
                ->update([
                    'stock' => $currentStock + $newStock
                ]);

                $count++;
            }

            DB::commit();
        } catch( \Exception $e ) {
            DB::rollBack();
            Log::error('Error creating purchase: ' . $e->getMessage());
            // Redirect back with an error message
            return back()->with('error', __('messages.purchases.create_error'));
        }

        return redirect()->route('compras.index')->with('success', __('messages.purchases.created_success'));
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
