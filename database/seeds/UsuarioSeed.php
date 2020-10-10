<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Insertar los usuarios en la base de datos (Un seed es cómo un plantilla)
        DB::table('users')->insert([
            'name' => 'Alfonso Iván Rodríguez Pineda',
            'telefono' => '5566902308',
            'email' => 'poncho@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('P0nch$95%'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => 'UserTest',
            'telefono' => '5523490176',
            'email' => 'test@gmail.com',
            'email_verified_at' => Carbon::now(),
            'password' => Hash::make('Test#23H&'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
