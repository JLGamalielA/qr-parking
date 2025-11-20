<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Icon extends Component
{
    /**
     * El nombre del icono 
     *
     * @var string
     */
    public $name;

    /**
     * La clase CSS final de FontAwesome
     *
     * @var string
     */
    public $iconClass;

    /**
     * Create a new component instance.
     *
     * @param  string  $name
     * @return void
     */
    public function __construct($name)
    {
        $this->name = $name;
        // Busca en config/icons.php. Si no encuentra la clave, pone un signo de interrogación.
        $this->iconClass = config('icons.' . $name, 'fa-solid fa-circle-question');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.icon');
    }
}