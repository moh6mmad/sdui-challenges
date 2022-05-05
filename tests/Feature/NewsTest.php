<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class NewsTests extends TestCase
{
    use RefreshDatabase;
    use Authenticatable;
    use WithoutMiddleware;


    
    /**
     * A basic feature test to check news index.
     *
     * @return void
     */
    public function testNewsShow()
    {
        $response = $this->json('GET', '/news');
        $response->assertStatus(200)->assertSee('data');
    }

    /**
     * A basic feature test to check news index.
     *
     * @return void
     */
    public function testCreateNews()
    {
        $this->actingAs(User::factory()->create())
        ->json('POST', '/news', ['title' => 'test', 'content' => 'content test'])
        ->assertStatus(201)
        ->assertSee('data');
    }

    /**
     * A basic feature test to check news index.
     *
     * @return void
     */
    public function testUpdateNews()
    {
        $user = User::factory()->create();
        $news = News::factory()->create();
        $this->actingAs($user)
        ->json('PUT', '/news/' . $news->id, ['title' => 'update test', 'content' => 'content test'])
        ->assertStatus(200)
        ->assertSee('data');
    }

    /**
     * A basic feature test to check news index.
     *
     * @return void
     */
    public function testDeleteNews()
    {
        $user = User::factory()->create();
        $news = News::factory()->create();
        $this->actingAs($user)
        ->json('DELETE', '/news/' . $news->id)
        ->assertStatus(204);
    }
}
