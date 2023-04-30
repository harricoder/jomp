<?php

declare(strict_types=1);

namespace Feature\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriesListTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_redirected_if_not_logged_in(): void
    {
        $response = $this->get('/categories');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_view_page_with_no_categories(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/categories');

        $response->assertStatus(200);
        $response->assertSeeText('No Categories Available');
    }

    public function test_view_list_of_categories(): void
    {
        $user = User::factory()->create();
        Category::factory()->create(['name' => 'Bass']);
        Category::factory()->create(['name' => 'Vocal']);

        $response = $this->actingAs($user)->get('/categories');

        $response->assertStatus(200);
        $response->assertSeeText('Bass');
        $response->assertSeeText('Vocal');
    }

    public function test_category_form_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/categories');

        $response->assertStatus(200);
        $response->assertSeeText('Category Name');
    }
}
