<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class Role extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['id'=> 1, 'name' => 'Admin'],
            ['id'=> 2, 'name' => 'Vendor'],
            ['id'=> 3, 'name' => 'User'],
        ]);
    }
}
