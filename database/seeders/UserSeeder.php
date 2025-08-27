<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Models\ACL\user;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [   
                'user_code' => 'su01',
                'user_name' => 'superadmin',
                'password' => Hash::make('12345678'),
                'remember_token' => Str::random(60),
                'created_at' =>  Carbon::now(),
                'updated_at' =>  Carbon::now()
            ],
        ];
        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}
