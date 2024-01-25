<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectInput extends Component
{
    public $options;
    public $selected;

    public function __construct($options, $selected = null)
    {
        $this->options = $options;
        $this->selected = $selected;
    }

    public function render()
    {
        return view('components.select-input');
    }
}
