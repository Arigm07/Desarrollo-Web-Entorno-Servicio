<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioS extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{
       DB::table('servicios')->insert([
        'descripcion'=>'Corte caballero',
        'precio'=>7.5
       ]);
       DB::table('servicios')->insert([
        'descripcion'=>'Corte señora',
        'precio'=>10
       ]);
       DB::table('servicios')->insert([
        'descripcion'=>'Corte cabello largo',
        'precio'=>8.5
       ]);
       DB::table('servicios')->insert([
        'descripcion'=>'Lavado',
        'precio'=>7
       ]);
       DB::table('servicios')->insert([
        'descripcion'=>'Tinte',
        'precio'=>15
       ]);
    }
}
