<?php

use Illuminate\Database\Seeder;

class ElementStrengthTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('element_strength')->insert([
            'element_id' => 1,
            'strength_id' => 3,
        ]);
        DB::table('element_strength')->insert([
            'element_id' => 2,
            'strength_id' => 1,
        ]);
        DB::table('element_strength')->insert([
            'element_id' => 3,
            'strength_id' => 2,
        ]);
    }
}
