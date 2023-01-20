<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
          // Order matters here
          AdminSeeder::class,
          CategorySeeder::class,
          SupplierSeeder::class,
          ProductSeeder::class,
          InvoiceSeeder::class,
          InvoiceDetailSeeder::class,
          PaymentSeeder::class,
        ]);
    }
}
