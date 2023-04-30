<?php

declare(strict_types=1);

namespace Feature\Categories;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryCreatedTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_creation_redirects_if_user_not_logged_in(): void
    {
        $response = $this->post('/categories');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_category_creation_errors(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->from('/categories')->post('/categories', ['name' => '']);

        $this->assertDatabaseCount('categories', 0);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
        $response->assertStatus(302)->assertRedirect('/categories');
    }

    public function test_new_category_created(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->from('/categories')->post('/categories', ['name' => 'Vocal']);

        $this->assertDatabaseHas('categories', [
            'name' => 'Vocal',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302)->assertRedirect('/categories');
    }
}
