<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('products')->insert([
              [
                'Name' => 'Carrelage1',
                'Description' => 'Un carrelage',
                'CategoryID' => '1',
                'SupplierID' => '1',
                'Price' => '60',
                'Reference' => 'PoEE60',
                'Quantity' => '200',
                'MinimumQty' => '20'
            ], [
              'Name' => 'Brick1',
              'Description' => 'Une brick',
              'CategoryID' => '2',
              'SupplierID' => '3',
              'Price' => '3',
              'Reference' => 'FoLA03',
              'Quantity' => '100',
              'MinimumQty' => '10'
            ], [
              'Name' => 'Iron1',
              'Description' => 'Du fer',
              'CategoryID' => '3',
              'SupplierID' => '2',
              'Price' => '40',
              'Reference' => 'RaMA40',
              'Quantity' => '500',
              'MinimumQty' => '50'
            ], [
              'Name' => 'Wood',
              'Description' => 'du bois',
              'CategoryID' => '4',
              'SupplierID' => '5',
              'Price' => '65',
              'Reference' => 'FuBE65',
              'Quantity' => '5',
              'MinimumQty' => '30'
            ], [
              'Name' => 'Jacket',
              'Description' => 'Coat like clothing',
              'CategoryID' => '5',
              'SupplierID' => '4',
              'Price' => '90',
              'Reference' => 'ClJA90',
              'Quantity' => '23',
              'MinimumQty' => '20'
            ],
          ]);
    }
}
