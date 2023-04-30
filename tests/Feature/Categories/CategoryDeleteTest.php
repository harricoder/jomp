<?php

declare(strict_types=1);

namespace Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_redirected_if_not_logged_in(): void
    {
        $response = $this->delete('/categories/vocal');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_category_deleted(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Vocal']);

        $response = $this->actingAs($user)->from('/categories/vocal')->delete('/categories/vocal');

        $this->assertModelMissing($category);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302)->assertRedirect('/categories');
    }
}
