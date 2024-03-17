<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{

    private function makeUser($type, $num) {
        DB::table('users')->upsert(
            [
                'name' => ucfirst($type) . $num,
                'email'=> $type . $num . '@example.com',
                'password' => bcrypt('password'),
                'created_at' => now(),
                'updated_at' => now(),
                'role' => $type
            ],
            ['name'],
            [
                'email',
                'password',
                'updated_at',
                'role'
            ]
        );
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 5; $i++) {
            $this->makeUser('user', $i+1);
        }
        for ($i = 0; $i < 3; $i++) {
            $this->makeUser('writer', $i+1);
        }

        for ($i = 1; $i < 3; $i++) {
            $this->makeUser('admin', $i+1);
        }

    }
}
