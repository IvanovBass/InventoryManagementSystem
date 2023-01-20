<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class categoryTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_cant_access_category()
    {
        $response = $this->get('/category/list');
        $response->assertStatus(302);
    }

    public function test_user_can_access_category()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/category/list');
        $response->assertStatus(200);
    }

    public function test_cant_add_category()
    {
        $response = $this->get('/category/add');
        $response->assertStatus(302);
    }

    public function test_user_can_add_category()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/category/add');
        $response->assertStatus(200);
    }

    public function test_cant_edit_category()
    {
        $response = $this->get('/category/edit/1');

        $response->assertStatus(302);
    }

    public function test_user_can_edit_category()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/category/edit/1'); // the specified id must be in the database for the test run true
        $response->assertStatus(200);
    }

    public function test_user_can_store_category()
    {
        $user = User::factory()->create();
        $db = Category::all()->count();
        $response = $this->actingAs($user)->post('category/store',[
            'name'=>'teste'
        ]);
        $response->assertRedirect('category/list');
        $this->assertCount($db+1,Category::all());
        $this->assertDatabaseHas('categories',['name'=>'teste']);
    }

    public function test_user_can_delete_category()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('category/delete/5'); // the specified id must be in the database for the test run true
        $response->assertStatus(302);
    }

    public function test_user_can_update_category()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post('category/update',[
            'id'=>'2',// the specified id must be in the database for the test run true
            'name'=>'tested'
        ]);
        $response->assertRedirect('category/list');
    }
}
