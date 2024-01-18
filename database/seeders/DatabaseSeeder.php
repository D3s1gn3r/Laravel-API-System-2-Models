<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User();
        $user->super_admin = 1;
        $user->name = 'Admin';
        $user->email = 'admin@admin.com';
        $user->password = Hash::make('12345678');
        $user->save();

        $user = new User();
        $user->super_admin = 1;
        $user->name = 'Ordinary User';
        $user->email = 'user@user.com';
        $user->password = Hash::make('87654321');
        $user->save();


        $vehicle = new Vehicle();
        $vehicle->user_id = 1;
        $vehicle->name = 'Tesla';
        $vehicle->model = 'S';
        $vehicle->vin  = '12345';
        $vehicle->save();

        $vehicle = new Vehicle();
        $vehicle->user_id = 1;
        $vehicle->name = 'Tesla';
        $vehicle->model = 'E';
        $vehicle->vin  = '123456';
        $vehicle->save();

        $vehicle = new Vehicle();
        $vehicle->user_id = 2;
        $vehicle->name = 'Tesla';
        $vehicle->model = 'X';
        $vehicle->vin  = '1234567';
        $vehicle->save();

        $vehicle = new Vehicle();
        $vehicle->user_id = 2;
        $vehicle->name = 'Tesla';
        $vehicle->model = 'Y';
        $vehicle->vin  = '12345678';
        $vehicle->save();
    }
}
