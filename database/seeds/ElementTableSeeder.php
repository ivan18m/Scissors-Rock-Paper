<?php

use Illuminate\Database\Seeder;

class ElementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('element')->insert([
            'name' => "Rock"
        ]);
        DB::table('element')->insert([
            'name' => "Paper"
        ]);
        DB::table('element')->insert([
            'name' => "Scissors"
        ]);
    }
}
