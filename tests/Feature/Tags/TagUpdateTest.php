<?php

declare(strict_types=1);

namespace Feature\Tags;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_tag_update_redirects_if_user_not_logged_in(): void
    {
        $response = $this->put('/tags/synth');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_tag_update_errors(): void
    {
        $user = User::factory()->create();
        Tag::factory()->create(['name' => 'Synth']);

        $response = $this->actingAs($user)->from('/tags/synth')->put('/tags/synth', ['name' => '']);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
        $response->assertStatus(302)->assertRedirect('/tags/synth');
    }

    public function test_tag_updated(): void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create(['name' => 'Synth']);

        $response = $this->actingAs($user)
            ->from('/tags/synth')
            ->put('/tags/synth', ['name' => 'Sound Design']);

        $tag->refresh();

        $this->assertSame('Sound Design', $tag->name);
        $this->assertSame('sound-design', $tag->slug);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302)->assertRedirect('/tags');
    }
}
