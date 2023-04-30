<?php

declare(strict_types=1);

namespace Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_update_redirects_if_user_not_logged_in(): void
    {
        $response = $this->put('/categories/vocal');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_category_update_errors(): void
    {
        $user = User::factory()->create();
        Category::factory()->create(['name' => 'Vocal']);

        $response = $this
            ->actingAs($user)
            ->from('/categories/vocal')
            ->put('/categories/vocal', ['name' => '']);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
        $response->assertStatus(302)->assertRedirect('/categories/vocal');
    }

    public function test_category_updated(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Synth']);

        $response = $this->actingAs($user)
            ->from('/categories/synth')
            ->put('/categories/synth', ['name' => 'Piano and Keys']);

        $category->refresh();

        $this->assertSame('Piano and Keys', $category->name);
        $this->assertSame('piano-and-keys', $category->slug);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302)->assertRedirect('/categories');
    }
}
