<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use App\Models\User;
use App\Models\Profile;
use App\Models\Governorate;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            GovernorateSeeder::class,
            RolePermissionSeeder::class,
        ]);

        // إنشاء مستخدم admin
        $user = User::factory()->create([
            'name' => 'admin',
            'email' => "test@gamil.com",
            'password' => bcrypt('TestP@ssword1233')
        ]);
        $user->assignRole('admin');

 $user2= User::factory()->create([
            'name' => 'user',
            'email' => "mohammedalmostfa36@gmail.com",
            'password' => bcrypt('mohammedalmostfa36@gmail.com')
        ]);
        $user2->assignRole('user');

         Profile::create([
            'user_id'       => $user2->id,
            'birthday'      => '1990-01-01',
            'phone'         => '1234567890',
            'address'       => '123 Main Street, City',
            'governorate_id'=> Governorate::first()?->id ?? 1, // أول محافظة موجودة أو افتراضية

        ]);
        Profile::create([
            'user_id'       => $user->id,
            'birthday'      => '1990-01-01',
            'phone'         => '1234567890',
            'address'       => '123 Main Street, City',
            'governorate_id'=> Governorate::first()?->id ?? 1, // أول محافظة موجودة أو افتراضية

        ]);



    }
}
