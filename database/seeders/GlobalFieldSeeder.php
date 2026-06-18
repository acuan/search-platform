<?php

namespace Database\Seeders;

use App\Models\GlobalField;
use Illuminate\Database\Seeder;

class GlobalFieldSeeder extends Seeder
{
    public function run(): void
    {
        $fields = [

            [
                'code' => 'name',
                'name' => 'Nombre'
            ],

            [
                'code' => 'email',
                'name' => 'Correo'
            ],

            [
                'code' => 'phone',
                'name' => 'Teléfono'
            ],

            [
                'code' => 'address',
                'name' => 'Dirección'
            ],

            [
                'code' => 'city',
                'name' => 'Ciudad'
            ],

            [
                'code' => 'state',
                'name' => 'Estado'
            ],

            [
                'code' => 'country',
                'name' => 'País'
            ],

            [
                'code' => 'company',
                'name' => 'Empresa'
            ],

            [
                'code' => 'tax_id',
                'name' => 'RFC'
            ],

            [
                'code' => 'customer_code',
                'name' => 'Código Cliente'
            ]
        ];

        foreach ($fields as $field) {

            GlobalField::firstOrCreate([
                'code' => $field['code']
            ], $field);
        }
    }
}
