<?php

namespace App\Http\Livewire;

use App\Models\Categoria;
use App\Models\Producto;
use App\Imports\CategoriesImport;
use App\Imports\ProductsImport;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use Livewire\Component;

class ImportController extends Component
{

    use WithFileUploads;
    public $contCategories, $contProducts, $fileCategories, $fileProducts;

    public function render()
    {
        return view('livewire.import.component')->extends('layouts.theme.app')
        ->section('content');;
    }


    public function uploadCategories()
    {
        $this->validate([
            'fileCategories' => 'required|mimes:xlsx,xls'
        ]);

        $cantBefore  =  Categoria::count();
        $import =  new CategoriesImport();
        Excel::import($import, $this->fileCategories);
         //$this->contCategories = $import->getRowCount();
         $this->fileCategories = '';
         $cantAfter = Categoria::count() - $cantBefore;
         $this->emit('categorias-agregadas', "SE IMPORTARON  $cantAfter CATEGORÍAS");
        //dd($cantAfter);

    }

    public function uploadProducts()
    {
        $this->validate([
            'fileProducts' => 'required|mimes:xlsx,xls'
        ]);
        $cantBefore = Producto::count();
        $import = new ProductsImport();
        Excel::import($import, $this->fileProducts);
        //$this->contProducts = $import->getRowCount();
        $this->fileProducts = '';
        $cantAfter = Producto::count() - $cantBefore;
        $this->emit('productos-agregados', "SE IMPORTARON  $cantAfter PRODUCTOS");
    }



}
