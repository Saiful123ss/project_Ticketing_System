<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\UserAdmin;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder {
    public function run() {
        UserAdmin::create([
            'name'=>'Admin',
            'email'=>'admin@example.com',
            'password'=>Hash::make('password123') // change password after
        ]);
    }
}
