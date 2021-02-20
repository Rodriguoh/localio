<?php

namespace App\View\Components;

use Illuminate\View\Component;

class infosStore extends Component
{
    public $store;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($store)
    {
        //

        $this->store = $store;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.infos-store');
    }
}
