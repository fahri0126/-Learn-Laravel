<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Unit;
use App\Models\User;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Kategori::factory(9)->create();
        Unit::factory(3)->create();
        Role::factory(2)->create();
        // User::factory(2)->create();
        // Produk::factory(10)->create();
    }
}
