<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GlobalField;


class GlobalFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        GlobalField::insert([
            ['name'=>'nombre','label'=>'Nombre','data_type'=>'string'],
            ['name'=>'telefono','label'=>'Teléfono','data_type'=>'string'],
            ['name'=>'correo','label'=>'Correo','data_type'=>'string'],
            ['name'=>'direccion','label'=>'Dirección','data_type'=>'string'],
            ['name'=>'curp','label'=>'CURP','data_type'=>'string'],
            ['name'=>'rfc','label'=>'RFC','data_type'=>'string'],
        ]);
    }
}
