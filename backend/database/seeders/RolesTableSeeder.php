<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;

class RolesTableSeeder extends Seeder {
    public function run(){
        DB::table('roles')->insert([
            ['name'=>'admin','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'manager','created_at'=>now(),'updated_at'=>now()],
            ['name'=>'user','created_at'=>now(),'updated_at'=>now()],
        ]);
    }
}
