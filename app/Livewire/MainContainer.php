<?php

namespace App\Livewire;

use Livewire\Component;

class MainContainer extends Component
{
    public $activeComponent= 'homepage';

    public function setActiveComponent($component)
    {
        $this->activeComponent = $component; // Set the active component
    }

    public function render()
    {
        return view('livewire.maincontainer'); // Return the view for this component
    }
}