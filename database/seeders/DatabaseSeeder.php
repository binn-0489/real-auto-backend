<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Ad;
use App\Models\AdminUser;
use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory(10)->create();
        Brand::factory(10)->create();
        Ad::factory(100)->create();
        AdminUser::factory(1)->create([
            'name' => 'Admin1',
            'email' => 'rusgul0004@gmail.com',
            'password' => bcrypt('0000'),
        ]);
    }
}
