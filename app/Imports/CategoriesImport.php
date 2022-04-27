<?php

namespace App\Imports;

use App\Models\Categoria;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;

class CategoriesImport implements ToModel, WithHeadingRow,  WithValidation, SkipsOnError
{

    use SkipsErrors;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Categoria([
            'nombre'   => $row['nombre']
        ]);
    }

    public function rules(): array
    {
        return [
            'nombre' => Rule::unique('categorias', 'nombre'),
        ];
    }

    public function customValidationMessages()
    {
        //'name.required' => 'Nombre de categoría requerido',
        return [
            'nombre.unique' => 'Ya existe la categoría'
        ];
    }

}
