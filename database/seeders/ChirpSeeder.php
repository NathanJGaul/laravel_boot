<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Chirp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::count() < 3
            ? collect([
                User::create([
                    'email' => 'John@email.com',
                    'name' => 'John',
                    'password' => bcrypt('password')
                ]),
                User::create([
                    'email' => 'Mike@email.com',
                    'name' => 'Mike',
                    'password' => bcrypt('password')
                ]),
                User::create([
                    'email' => 'Norman@email.com',
                    'name' => 'Norman',
                    'password' => bcrypt('password')
                ]),
            ])
            : User::take(3)->get();

        $chirps = [
            'Some random message here',
            'Foo bar baz',
            'Typing is fun',
            'a very important thought'
        ];

        foreach ($chirps as $chirp) {
            $users->random()->chirps()->create([
                'message' => $chirp,
                'created_at' => now()->subMinutes(rand(5, 1440))
            ]);
        }
    }
}
