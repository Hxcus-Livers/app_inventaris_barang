<?php

namespace App\Livewire;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        $x['title'] = "Home Inventaris Barang";
        return view('livewire.home-component');
    }
}
