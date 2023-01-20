<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('payments')->insert([
              [
                'invoice_no' => '1',
                'total_amount' => 42*60 + 52*3
              ], [
                'invoice_no' => '2',
                'total_amount' => 34*3 + 73*40
              ], [
                'invoice_no' => '3',
                'total_amount' => 377*40 + 73*65
              ], [
                'invoice_no' => '4',
                'total_amount' => 43*65 + 53*90
              ], [
                'invoice_no' => '5',
                'total_amount' => 568*90 + 47*60
              ],
          ]);
    }
}
