<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use Livewire\Component;

class FacturasController extends Component
{

    public function render()
    {

        return view('livewire.facturas.component'
        )->extends('layouts.theme.app')
		->section('content');

    }
}
