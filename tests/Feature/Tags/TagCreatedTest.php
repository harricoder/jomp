<?php

declare(strict_types=1);

namespace Feature\Tags;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagCreatedTest extends TestCase
{
    use RefreshDatabase;

    public function test_tag_creation_redirects_if_user_not_logged_in(): void
    {
        $response = $this->post('/tags');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_tag_creation_errors(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->from('/tags')->post('/tags', ['name' => '']);

        $this->assertDatabaseCount('tags', 0);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
        $response->assertStatus(302)->assertRedirect('/tags');
    }

    public function test_new_tag_created(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->from('/tags')->post('/tags', ['name' => 'Awesome Tag']);

        $this->assertDatabaseHas('tags', [
            'name' => 'Awesome Tag',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302)->assertRedirect('/tags');
    }
}
