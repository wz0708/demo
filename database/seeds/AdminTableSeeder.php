<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //
        DB::table('admins')->insert([
            'name' => 'admin',
            'password' => bcrypt('123456'),
            'auth' => ' ',
        ]);
    }

}
