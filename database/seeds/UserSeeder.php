<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id_unit' => 1,
                'id_jabatan' => 1,
                'nik' => '0101001',
                'nama_user' => 'Administrator',
                'email' => 'admin@email.com',
                'password' => bcrypt('admin'),
                'isAdmin' => 1,
                'status' => 1,
                'created_at' => NOW(),
                'updated_at' => NOW()
            ]
        ]);
    }
}
