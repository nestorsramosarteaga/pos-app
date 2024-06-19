<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmModal extends Component
{
    public $ruta;
    public $estado;
    public $key;
    public $id;
    public $type;
    /**
     * Create a new component instance.
     */
    public function __construct($ruta, $estado, $key, $id, $type)
    {
        $this->ruta = $ruta;
        $this->estado = $estado;
        $this->key = $key;
        $this->id = $id;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.confirm-modal');
    }
}
