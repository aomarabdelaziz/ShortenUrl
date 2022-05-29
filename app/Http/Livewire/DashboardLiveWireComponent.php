<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DashboardLiveWireComponent extends Component
{
    public $count =  0;
    public function increment()
    {
        $this->count ++;
    }
    public function render()
    {
        return view('livewire.dashboard-index')
            ->extends('layouts.main');
    }
}
