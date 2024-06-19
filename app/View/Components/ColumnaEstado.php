<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ColumnaEstado extends Component
{

    public $estado;

    /**
     * Create a new component instance.
     */
    public function __construct($estado)
    {
        $this->estado = $estado;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.columna-estado');
    }
}
