<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputField extends Component
{
    public $label;
    public $name;
    public $value;
    public $required;
    public $maxLength;
    public $error;
    public $type;
    public $col;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $label,
        $name,
        $value = "",
        $required = false,
        $maxLength = 255,
        $error = null,
        $type = 'text',
        $col = 12
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->required = $required;
        $this->maxLength = $maxLength;
        $this->error = $error;
        $this->col = $col;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.input-field');
    }
}
