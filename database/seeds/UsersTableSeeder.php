<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('users')->insert(array(
        [
         'name' => 'admin', 
         'email' => 'admin@pos.com',
         'password' => bcrypt('admin'),
         'foto' => 'user.png',
         'level' => 1
        ],
        [
         'name' => 'Annisa Salsabila', 
         'email' => 'annisasalsabila@pos.com',
         'password' => bcrypt('070217'),
         'foto' => 'user.png',
         'level' => 1
        ],
        [
         'name' => 'Lelouch Al Khaidar', 
         'email' => 'lelouch@gmail.com',
         'password' => bcrypt('lelouch'),
         'foto' => 'user.png',
         'level' => 2
        ],
        [
         'name' => 'levi', 
         'email' => 'levi@gmail.com',
         'password' => bcrypt('levi'),
         'foto' => 'user.png',
         'level' => 2
        ]
      ));

    }
}
