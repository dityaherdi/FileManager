<?php

use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            [
                'nama_unit' => 'Administrator',
                'nama_folder' => 'Administrator',
                'status' => 1,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ]);
    }
}
