<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Unidades;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsErrors;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Illuminate\Validation\Rule;


class ProductsImport implements ToModel, WithHeadingRow,  WithValidation, SkipsOnError
{
    use SkipsErrors;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Producto([
            'nombre'            => $row['nombre'],
            'barcode'         => $row['codigo'],
            'costo'            => $row['costo'],
            'precio'           => $row['precio'],
            'pvp'               => $row['pvp'],
            'stock'           => $row['stock'],
            'alertas'          => $row['alertas'],
            'categoria_id'     => Categoria::where('nombre', $row['categoria'])->first()->id,
            'unidad_id'     => Unidades::where('nombre', $row['unidad'])->first()->id,
        ]);
    }

    //encabezados del archivo excel
    public function rules(): array
    {
        return [
            'nombre' => Rule::unique('productos', 'nombre'),
            'barcode' => Rule::unique('productos', 'barcode'),
        ];
    }
}
