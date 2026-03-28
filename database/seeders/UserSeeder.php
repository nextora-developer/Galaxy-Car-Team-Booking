<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Always seed in all environments
        |--------------------------------------------------------------------------
        */
        User::updateOrCreate(
            ['email' => 'admin@galaxy.my'],
            [
                'name' => 'Admin Boss',
                'password' => Hash::make('galaxycarteam'),
                'role' => 'admin',
                'shift' => null,
                'driver_status' => null,
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@user.com'],
            [
                'name' => 'Test User',
                'full_name' => 'Lau Tak Wah',
                'phone' => '0167223344',
                'password' => Hash::make('password'),
                'role' => 'user',
                'shift' => null,
                'driver_status' => null,
            ]
        );

        /*
        |--------------------------------------------------------------------------
        | Local only
        |--------------------------------------------------------------------------
        */
        if (! App::environment('local')) {
            return;
        }

        // Manager Day
        User::updateOrCreate(
            ['email' => 'manager_day@manager.com'],
            [
                'name' => 'Manager Day',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'shift' => 'day',
                'driver_status' => null,
            ]
        );

        // Manager Night
        User::updateOrCreate(
            ['email' => 'manager_night@manager.com'],
            [
                'name' => 'Manager Night',
                'password' => Hash::make('password'),
                'role' => 'manager',
                'shift' => 'night',
                'driver_status' => null,
            ]
        );

        // Driver Day
        User::updateOrCreate(
            ['email' => 'driver_day@driver.com'],
            [
                'name'          => 'Driver Day',
                'full_name'     => 'Ahmad Faiz',
                'phone'         => '0123456789',
                'car_plate'     => 'VCD1234',
                'car_model'     => 'Perodua Bezza 1.3',
                'bank_name'     => 'Maybank',
                'bank_account'  => '123456789012',
                'password'      => Hash::make('password'),
                'role'          => 'driver',
                'shift'         => 'day',
                'driver_status' => 'approved',
                'is_online'     => 1,
            ]
        );

        // Driver Night
        User::updateOrCreate(
            ['email' => 'driver_night@driver.com'],
            [
                'name'          => 'Driver Night',
                'full_name'     => 'Siva Kumar',
                'phone'         => '0198765432',
                'car_plate'     => 'WXY5678',
                'car_model'     => 'Toyota Vios 1.5',
                'bank_name'     => 'CIMB Bank',
                'bank_account'  => '987654321098',
                'password'      => Hash::make('password'),
                'role'          => 'driver',
                'shift'         => 'night',
                'driver_status' => 'approved',
                'is_online'     => 1,
            ]
        );

        // Driver 3 - Day
        User::updateOrCreate(
            ['email' => 'driver3@driver.com'],
            [
                'name'          => 'Driver Lee',
                'full_name'     => 'Lee Wei Jun',
                'phone'         => '0132233445',
                'car_plate'     => 'ABC4321',
                'car_model'     => 'Honda City 1.5',
                'bank_name'     => 'Public Bank',
                'bank_account'  => '112233445566',
                'password'      => Hash::make('password'),
                'role'          => 'driver',
                'shift'         => 'day',
                'driver_status' => 'approved',
                'is_online'     => 1,
            ]
        );

        // Driver 4 - Night
        User::updateOrCreate(
            ['email' => 'driver4@driver.com'],
            [
                'name'          => 'Driver Tan',
                'full_name'     => 'Tan Kok Leong',
                'phone'         => '0145566778',
                'car_plate'     => 'JKL8899',
                'car_model'     => 'Nissan Almera',
                'bank_name'     => 'RHB Bank',
                'bank_account'  => '223344556677',
                'password'      => Hash::make('password'),
                'role'          => 'driver',
                'shift'         => 'night',
                'driver_status' => 'approved',
                'is_online'     => 1,
            ]
        );

        // Driver 5 - Day (Offline)
        User::updateOrCreate(
            ['email' => 'driver5@driver.com'],
            [
                'name'          => 'Driver Lim',
                'full_name'     => 'Lim Jia Hao',
                'phone'         => '0169988776',
                'car_plate'     => 'MNO5566',
                'car_model'     => 'Proton X50',
                'bank_name'     => 'Hong Leong Bank',
                'bank_account'  => '334455667788',
                'password'      => Hash::make('password'),
                'role'          => 'driver',
                'shift'         => 'day',
                'driver_status' => 'approved',
                'is_online'     => 1,
            ]
        );

        // Driver 6 - Night (Pending)
        User::updateOrCreate(
            ['email' => 'driver6@driver.com'],
            [
                'name'          => 'Driver Raj',
                'full_name'     => 'Rajesh Kumar',
                'phone'         => '0171122334',
                'car_plate'     => 'PQR7788',
                'car_model'     => 'Perodua Myvi',
                'bank_name'     => 'Maybank',
                'bank_account'  => '445566778899',
                'password'      => Hash::make('password'),
                'role'          => 'driver',
                'shift'         => 'night',
                'driver_status' => 'approved',
                'is_online'     => 1,
            ]
        );

        // Driver 7 - Day
        User::updateOrCreate(
            ['email' => 'driver7@driver.com'],
            [
                'name'          => 'Driver Wong',
                'full_name'     => 'Wong Kai Sheng',
                'phone'         => '0182233445',
                'car_plate'     => 'STU1122',
                'car_model'     => 'Toyota Corolla',
                'bank_name'     => 'CIMB Bank',
                'bank_account'  => '556677889900',
                'password'      => Hash::make('password'),
                'role'          => 'driver',
                'shift'         => 'day',
                'driver_status' => 'approved',
                'is_online'     => 1,
            ]
        );
    }
}
