<?php

namespace Tests\Feature;

use App\Models\Supplier;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class suppliersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cant_access_suppliers()
    {
        $response = $this->get('/suppliers/list');
        $response->assertStatus(302);
    }

    public function test_user_can_access_suppliers()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/suppliers/list');
        $response->assertStatus(200);
    }

    public function test_cant_add_suppliers()
    {
        $response = $this->get('/suppliers/add');
        $response->assertStatus(302);
    }

    public function test_user_can_add_suppliers()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/suppliers/add');
        $response->assertStatus(200);
    }

    public function test_cant_edit_suppliers()
    {
        $response = $this->get('/suppliers/edit/1');

        $response->assertStatus(302);
    }

    public function test_user_can_edit_suppliers()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/suppliers/edit/1'); // the specified id must be in the database for the test run true
        $response->assertStatus(200);
    }

    public function test_user_can_store_suppliers()
    {
        $user = User::factory()->create();
        $db = Supplier::all()->count();
        $response = $this->actingAs($user)->post('suppliers/store',[
            'name'=>'test',
            'phone'=>'156',
            'email'=>'t@toto.com'
        ]);
        $response->assertRedirect('suppliers/list');
        $this->assertCount($db+1,Supplier::all());
        $this->assertDatabaseHas('suppliers',['name'=>'test']);
    }

    public function test_user_can_delete_suppliers()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('suppliers/delete/5'); // the specified id must be in the database for the test run true
        $response->assertStatus(302);
    }

    public function test_user_can_update_suppliers()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('suppliers/update',[
            'id'=>'1',// the specified id must be in the database for the test run true
            'name'=>'test',
            'phone' => '1567',
            'email' =>'tested@test.com'
        ]);
        $response->assertRedirect('suppliers/list');
    }
}
