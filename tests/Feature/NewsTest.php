<?php

namespace Tests\Feature;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Authenticatable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;

class NewsTests extends TestCase
{
    use RefreshDatabase;
    use Authenticatable;
    use WithFaker;

    protected $user;
    protected $news;

    protected function setup(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->news = News::factory()->create();
    }
    
    /**
     * A basic feature test to check news index.
     *
     * @return void
     */
    public function testNewsShow()
    {
        $this->actingAs($this->user);
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
        $this->actingAs($this->user)
        ->json('POST', '/news', ['title' => $this->faker->realText(50), 'content' => $this->faker->paragraph(),])
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
        $title = $this->faker->realText(50);
        $content = $this->faker->paragraph();
        $this->actingAs($this->user)
        ->json('PUT', '/news/' . $this->news->id, ['title' => $title, 'content' => $content])
        ->assertStatus(200)
        ->assertJsonFragment([
            'title' => $title,
            'content' => $content,
        ])
        ->assertSee('data');
    }

    /**
     * A basic feature test to check news index.
     *
     * @return void
     */
    public function testDeleteNews()
    {
        $this->actingAs($this->user)
        ->json('DELETE', '/news/' . $this->news->id)
        ->assertStatus(204);
    }

    /**
     * A basic feature test to check news index.
     *
     * @return void
     */
    public function testAssignNews()
    {
        $user = User::factory()->create();
        $this->actingAs($user)
        ->json('POST', route('news.assign', $this->news))
        ->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
        ])
        ->assertStatus(201);
    }
}
