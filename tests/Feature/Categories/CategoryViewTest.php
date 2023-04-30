<?php

declare(strict_types=1);

namespace Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_redirected_if_not_logged_in(): void
    {
        $response = $this->get('/categories/synth');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_tag_can_be_viewed(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Piano and Keys']);

        $response = $this->actingAs($user)->get('/categories/piano-and-keys');

        $response->assertStatus(200);
        $response->assertSeeText('Piano and Keys');
        $response->assertSeeText('Update Category');
        $response->assertSeeText('Delete Category');
    }
}
