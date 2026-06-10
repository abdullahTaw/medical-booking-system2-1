<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SelectField extends Component
{
    public $label;
    public $name;
    public $options;
    public $value;
    public $required;
    public $error;
    public $col;

    /**
     * Create a new component instance.
     */
    public function __construct($label, $name, $options = [], $value = "", $required = false, $error = null, $col= 12)
    {
        $this->label = $label;
        $this->name = $name;
        $this->options = $options;
        $this->value = $value;
        $this->required = $required;
        $this->error = $error;
        $this->col = $col;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.select-field');
    }
}
