<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ColumnaAcciones extends Component
{
    public $ruta;
    public $estado;
    public $key;
    public $value;
    public $botonVer;

    public $botonEdit;
    /**
     * Create a new component instance.
     */
    public function __construct($ruta, $estado, $key, $value, $botonVer=0, $botonEdit=1)
    {
        $this->ruta = $ruta;
        $this->estado = $estado;
        $this->key = $key;
        $this->value = $value;
        $this->botonVer = $botonVer;
        $this->botonEdit = $botonEdit;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.columna-acciones');
    }
}
