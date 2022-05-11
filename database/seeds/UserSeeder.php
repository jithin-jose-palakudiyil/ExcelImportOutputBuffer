<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          if(DB::table('users')->get()->count() == 0){
             $tasks =  [
                            [
                                'name'      =>  'Admin',
                                'email'     =>  'admin@admin.com',
                                'email_verified_at'    => \DB::raw('CURRENT_TIMESTAMP'), 
                                'password'  =>  bcrypt('password'),
                                'remember_token'  => null,
                            ],
                        ];
             
             DB::table('users')->insert($tasks);
         }
    }
}
