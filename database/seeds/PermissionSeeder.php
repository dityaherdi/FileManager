<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'id_user' => 1,
                'view' => 1,
                'create' => 1,
                'update' => 1,
                'delete' => 1,
            ]
        ]);
    }
}
