<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categorias')->insert([
            'categoria' => 'Restaurant',
            'slug' => Str::slug('Restaurant'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Café',
            'slug' => Str::slug('Café'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Hotel',
            'slug' => Str::slug('Hotel'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Bar',
            'slug' => Str::slug('Bar'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Hospital',
            'slug' => Str::slug('Hospital'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Gimnasio',
            'slug' => Str::slug('Gimnasio'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('categorias')->insert([
            'categoria' => 'Centros Comerciales',
            'slug' => Str::slug('Centros Comerciales'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
