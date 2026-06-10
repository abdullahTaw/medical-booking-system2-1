<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextareaField extends Component
{
    public $label;
    public $name;
    public $value;
    public $required;
    public $error;
    public $col;
    public $height;
    public $maxLength;

    /**
     * Create a new component instance.
     */
    public function __construct($label, $name, $value = null, $height = 100, $required = false, $error = null, $col= 12, $maxLength= 10000)
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
        $this->required = $required;
        $this->error = $error;
        $this->col = $col;
        $this->height = $height;
        $this->maxLength = $maxLength;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea-field');
    }
}
