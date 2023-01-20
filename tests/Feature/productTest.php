<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class productTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_cant_access_product()
    {
        $response = $this->get('/product/list');
        $response->assertStatus(302);
    }

    public function test_user_can_access_product()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/product/list');
        $response->assertStatus(200);
    }

    public function test_cant_add_product()
    {
        $response = $this->get('/product/add');
        $response->assertStatus(302);
    }

    public function test_user_can_add_product()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/product/add');
        $response->assertStatus(200);
    }

    public function test_cant_edit_product()
    {
        $response = $this->get('/product/edit/1');

        $response->assertStatus(302);
    }

    public function test_user_can_edit_product()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/product/edit/2'); // the specified id must be in the database for the test run true
        $response->assertStatus(200);
    }

    public function test_user_can_store_product()
    {
        $user = User::factory()->create();
        $db = Product::all()->count();
        $response = $this->actingAs($user)->post('product/store',[
            'Name'=>'test',
            'Description'=>'test',
            'CategoryID'=>'1',
            'SupplierID'=>'1',
            'Price'=>'156',
            'Image'=>'',
            'Reference'=>'156',
            'Quantity'=>'10',
            'MinimumQty'=>'10'
        ]);
        $response->assertRedirect('product/list');
        $this->assertCount($db+1,Product::all());
        $this->assertDatabaseHas('products',['Name'=>'test']);
    }

    public function test_user_can_delete_product()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('product/delete/27'); // the specified id must be in the database for the test run true
        $response->assertStatus(302);
    }

    public function test_user_can_update_product()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('product/update',[
            'id'=>'8',// the specified id must be in the database for the test run true
            'Name'=>'tested',
            'Description' => 'tested',
            'CategoryID' =>'1',
            'SupplierID' => '1',
            'Price' => '156',
            'Image' => '',
            'Reference' => '651',
            'Quantity' => '10',
            'MinimumQty' => '5'
        ]);
        $response->assertRedirect('product/list');
    }
}
