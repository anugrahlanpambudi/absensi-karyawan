<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Office;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1️⃣ Buat Office dulu
        $office = Office::create([
            'name' => 'Kantor Pusat',
            'latitude' => -6.200000,
            'longitude' => 106.816666,
            'radius' => 100,
        ]);

        // 2️⃣ Buat roles
        Role::firstOrCreate(['name' => 'super-admin']);
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);

        // 3️⃣ Buat Super Admin
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => Hash::make('12345678'),
            'office_id' => $office->id, // ✅ pakai id dari office yang baru dibuat
        ]);

        $superAdmin->assignRole('super-admin');

        // 4️⃣ Buat Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'office_id' => $office->id,
        ]);

        $admin->assignRole('admin');
    }
}
