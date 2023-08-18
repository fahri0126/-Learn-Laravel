<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Unit;
use App\Models\User;
use App\Models\Pesan;
use App\Models\Produk;
use App\Models\Biodata;
use App\Models\Kategori;
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

        Biodata::factory(10)->create();
        Pesan::factory(10)->create();
        Kategori::factory(6)->create();
        Unit::factory(3)->create();
        User::factory(2)->create();
        Produk::factory(40)->create();
    }
}
