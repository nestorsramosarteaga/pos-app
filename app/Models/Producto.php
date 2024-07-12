<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Producto extends Model
{
    use HasFactory;

    protected $fillable = [ 'codigo', 'nombre', 'descripcion', 'fecha_vencimiento', 'marca_id', 'presentacione_id', 'img_path'];

    /**
     * Get only active products (estado = 1).
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function active()
    {
        return self::where('estado', 1)->get();
    }

    public function compras(){
        return $this->belongsToMany(Compra::class)->withTimestamps()
            ->withPivot('cantidad','precio_compra','precio_venta');
    }

    public function ventas(){
        return $this->belongsToMany(Venta::class)->withTimestamps()
            ->withPivot('cantidad','precio_venta','descuento');
    }

    public function categorias(){
        return $this->belongsToMany(Categoria::class)->withTimestamps();
    }

    public function marca(){
        return $this->belongsTo(Marca::class);
    }

    public function presentacione(){
        return $this->belongsTo(Presentacione::class);
    }

    public function handleUploadImage($image){
        $file = $image;
        $name = time() . $file->getClientOriginalName();
        // $file->move(public_path() . '/img/productos/' , $name);
        Storage::putFileAs('productos', $file, $name, 'public'); // 'public/productos'
        return $name;
    }

}
