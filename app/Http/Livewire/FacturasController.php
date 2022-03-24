<?php

namespace App\Http\Livewire;

use App\Models\Empresa;
use Livewire\Component;

class FacturasController extends Component
{

    public function render()
    {
        $empresa =  Empresa::all();
        return view('livewire.facturas.component', compact('empresa'))->extends('layouts.theme.app')
		->section('content');

    }
}
