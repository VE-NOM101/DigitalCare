<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        if (DB::table('roles')->count() === 0) {
            // If it's empty, insert roles
            DB::table('roles')->insert([
                ['name' => 'user'],
                ['name' => 'doctor'],
                ['name' => 'pharmacist'],
                ['name' => 'admin'],
                ['name' => 'nurse'],
            ]);
        } else {
            // If roles exist, inform the user
            echo "Roles already exist in the database. Skipping seeding.\n";
        }
    }
}
