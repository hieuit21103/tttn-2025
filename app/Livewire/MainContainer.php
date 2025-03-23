<?php

namespace App\Livewire;

use Livewire\Component;

class MainContainer extends Component
{
    public $activeComponent = 'homepage';

    public function setActiveComponent($component)
    {
        $this->activeComponent = $component;
    }

    public function render()
    {
        return view('livewire.maincontainer');
    }
}