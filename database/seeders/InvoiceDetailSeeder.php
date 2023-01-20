<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('invoice_details')->insert([
              [
                'date' => date('y-m-d h:i:s'),
                'invoice_no' => '1',
                'category_id' => '1',
                'product_id' => '1',
                'buying_qty' => '42',
                'unit_price' => '60',
                'selling_price' => 42*60,
                'status' => '0'
              ], [
                'date' => date('y-m-d h:i:s'),
                'invoice_no' => '1',
                'category_id' => '2',
                'product_id' => '2',
                'buying_qty' => '52',
                'unit_price' => '3',
                'selling_price' => 52*3,
                'status' => '0'
              ], [
                'date' => date('y-m-d h:i:s'),
                'invoice_no' => '2',
                'category_id' => '2',
                'product_id' => '2',
                'buying_qty' => '34',
                'unit_price' => '3',
                'selling_price' => 34*3,
                'status' => '0'
              ], [
                'date' => date('y-m-d h:i:s'),
                'invoice_no' => '2',
                'category_id' => '3',
                'product_id' => '3',
                'buying_qty' => '73',
                'unit_price' => '40',
                'selling_price' => 73*40,
                'status' => '0'
              ], [
                'date' => date('y-m-d h:i:s'),
                'invoice_no' => '3',
                'category_id' => '3',
                'product_id' => '3',
                'buying_qty' => '377',
                'unit_price' => '40',
                'selling_price' => 377*40,
                'status' => '1'
              ], [
                'date' => date('y-m-d h:i:s'),
                'invoice_no' => '3',
                'category_id' => '4',
                'product_id' => '4',
                'buying_qty' => '73',
                'unit_price' => '65',
                'selling_price' => 73*65,
                'status' => '1'
              ], [
                'date' => date('y-m-d h:i:s'),
                'invoice_no' => '4',
                'category_id' => '4',
                'product_id' => '4',
                'buying_qty' => '43',
                'unit_price' => '65',
                'selling_price' => 43*65,
                'status' => '0'
              ], [
                'date' => date('y-m-d h:i:s'),
                'invoice_no' => '4',
                'category_id' => '5',
                'product_id' => '5',
                'buying_qty' => '53',
                'unit_price' => '90',
                'selling_price' => 53*90,
                'status' => '0'
              ], [
                'date' => date('y-m-d h:i:s'),
                'invoice_no' => '5',
                'category_id' => '5',
                'product_id' => '5',
                'buying_qty' => '568',
                'unit_price' => '90',
                'selling_price' => 568*90,
                'status' => '1'
              ], [
                'date' => date('y-m-d h:i:s'),
                'invoice_no' => '5',
                'category_id' => '1',
                'product_id' => '1',
                'buying_qty' => '47',
                'unit_price' => '60',
                'selling_price' => 47*60,
                'status' => '1'
            ],
          ]);
    }
}
