<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('categories')->insert([
              [
                'name' => 'Carrelage',
                'created_at' => date('y-m-d h:i:s')
            ], [
                'name' => 'Brick',
                'created_at' => date('y-m-d h:i:s')
            ], [
                'name' => 'Iron beams',
                'created_at' => date('y-m-d h:i:s')
            ], [
                'name' => 'Outils',
                'created_at' => date('y-m-d h:i:s')
            ], [
                'name' => 'Work Clothes',
                'created_at' => date('y-m-d h:i:s')
            ]
          ]);
    }
}
