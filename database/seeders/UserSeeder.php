<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Kim Maravilla',
            'email' => 'kimluari+dev@gmail.com',
            'password' => bcrypt('n05O96!jWwRfny2GAwtI'),
        ]);

        User::factory()->create([
            'name' => 'Lyra Jane Bonaog',
            'email' => 'bonaoglyrajane+dev@gmail.com',
            'password' => bcrypt('Y9r@7ke8#0*u2a%jjFU1'),
        ]);

        User::factory()->count(8)->create();
    }
}
