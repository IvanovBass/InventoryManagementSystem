<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('invoices')->insert([
              [
                'invoice_no' => '978654312',
                'date' => date('y-m-d h:i:s'),
                'description' => 'Lorem Ipsum',
                'status' => '0',
                'created_by' => '1'
            ], [
                'invoice_no' => '76786786',
                'date' => date('y-m-d h:i:s'),
                'description' => 'Lorem Ipsum',
                'status' => '0',
                'created_by' => '1'
            ], [
                'invoice_no' => '37378387',
                'date' => date('y-m-d h:i:s'),
                'description' => 'Lorem Ipsum',
                'status' => '1',
                'created_by' => '2'
            ], [
                'invoice_no' => '783737',
                'date' => date('y-m-d h:i:s'),
                'description' => 'Lorem Ipsum',
                'status' => '0',
                'created_by' => '1'
            ], [
                'invoice_no' => '38737888',
                'date' => date('y-m-d h:i:s'),
                'description' => 'Lorem Ipsum',
                'status' => '1',
                'created_by' => '2'
            ]
          ]);
    }
}
