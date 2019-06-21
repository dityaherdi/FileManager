<?php

use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('jabatans')->insert([
            [
                'nama_jabatan' => 'Pimpinan',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ],
            [
                'nama_jabatan' => 'Staff',
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ]);
    }
}
