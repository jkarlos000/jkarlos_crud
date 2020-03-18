<?php

use App\Libreria;
use App\Libro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        //DB::statement('SET FOREIGN_KEYS_CHECKS = 0');
        DB::statement('SET FOREIGN_KEY_CHECKS = 0'); //MySql
        Libro::truncate();
        Libreria::truncate();

        $countLibreria = 50;
        $countLibros = 5000;

        factory(Libreria::class, $countLibreria)->create();
        factory(Libro::class, $countLibros)->create();
    }
}
