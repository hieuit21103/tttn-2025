<?php

namespace App\Livewire;

use Livewire\Component;

class MainContainer extends Component
{
    public $activeComponent = 'pending-approvals';
    public $activeMenu = '';

    public function setActiveComponent($component)
    {
        $this->activeComponent = $component;
    }

    public function toggleMenu($menu)
    {
        if($this->activeMenu === $menu) {
            $this->activeMenu = '';
        } else {
            $this->activeMenu = $menu;
        }
    }

    public function render()
    {
        return view('livewire.maincontainer');
    }
}