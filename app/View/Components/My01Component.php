<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class My01Component extends Component
{
    /**
     * Create a new component instance.
     */
    public $myProperty1 ;
    public function __construct( $myProperty1 )
    {
        //
        $this->myProperty1 = $myProperty1 ;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.my01-component' , ['myProperty1' => $this->myProperty1] );
    }
}
