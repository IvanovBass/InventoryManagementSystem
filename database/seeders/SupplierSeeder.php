<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('suppliers')->insert([
              [
                'name' => 'Bigmat',
                'email' => 'bigmat@gmail.com',
                'phone' => '6451328709',
                'created_at' => date('y-m-d h:i:s')
            ], [
                'name' => 'Denmart',
                'email' => 'Denmart@gmail.com',
                'phone' => '8653563874',
                'created_at' => date('y-m-d h:i:s')
            ], [
                'name' => 'Brico',
                'email' => 'Brico@gmail.com',
                'phone' => '86534896250',
                'created_at' => date('y-m-d h:i:s')
            ], [
                'name' => 'evilen',
                'email' => 'evil@gmail.com',
                'phone' => '76325966301',
                'created_at' => date('y-m-d h:i:s')
            ], [
                'name' => 'boss',
                'email' => 'boss@gmail.com',
                'phone' => '1445287786',
                'created_at' => date('y-m-d h:i:s')
            ]
          ]);
    }
}
