<?php

namespace Database\Seeders;

use App\Models\SubCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'admin',
            'email' => "test@gamil.com",
            'password' => bcrypt('TestP@ssword1233')
        ]);
        $this->call([
            CountrySeeder::class,
        ]);
    }
}
