<?php

use Illuminate\Database\Seeder;
use App\Articulo;
class ArticuloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //borramos los campos
        DB::table('articulos')->truncate();
        //ahora vamos a rellenar la tabla articulos manualmente;

        // Bazar, Hogar, Elećtronica
        Articulo::create([
            'nombre'=>'Alexa',
            'categoria'=>'Electrónica',
            'pvp'=>'150',
            'stock'=>'25'
        ]);

        Articulo::create([
            'nombre'=>'Iphone X',
            'categoria'=>'Electrónica',
            'pvp'=>'700',
            'stock'=>'15'
        ]);

        Articulo::create([
            'nombre'=>'Armario',
            'categoria'=>'Hogar',
            'pvp'=>'300',
            'stock'=>'2'
        ]);

        Articulo::create([
            'nombre'=>'Percha',
            'categoria'=>'Bazar',
            'pvp'=>'15',
            'stock'=>'22'
        ]);

        Articulo::create([
            'nombre'=>'Cascos',
            'categoria'=>'Electrónica',
            'pvp'=>'30',
            'stock'=>'12'
        ]);

        Articulo::create([
            'nombre'=>'Sofá',
            'categoria'=>'Hogar',
            'pvp'=>'120',
            'stock'=>'10'
        ]);

        Articulo::create([
            'nombre'=>'Pesas',
            'categoria'=>'Bazar',
            'pvp'=>'25',
            'stock'=>'12'
        ]);
    }
}
