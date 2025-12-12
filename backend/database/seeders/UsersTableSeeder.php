<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class UsersTableSeeder extends Seeder {
    public function run(){
        User::create([
            'name'=>'Admin Demo',
            'email'=>'admin@example.com',
            'password'=>Hash::make('password'),
            'role_id'=>1,
            'control_number'=>'0001'
        ]);
        // Crear usuarios demo adicionales...
    }
}
