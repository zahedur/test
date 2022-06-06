<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $user = new User();
        $user->name = 'Zahedur';
        $user->email = 'zahedur@admin.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('123456789');
        $user->remember_token = Str::random(10);
        $user->save();

        $user = new User();
        $user->name = 'Rakib Rahman';
        $user->email = 'rakib@admin.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('123456789');
        $user->remember_token = Str::random(10);
        $user->save();

        $user = new User();
        $user->name = 'Sajib';
        $user->email = 'sajib@admin.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('123456789');
        $user->remember_token = Str::random(10);
        $user->save();

    }
}
