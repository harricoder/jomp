<?php

declare(strict_types=1);

namespace Feature\Tags;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_redirected_if_not_logged_in(): void
    {
        $response = $this->get('/tags/synth');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_tag_can_be_viewed(): void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create(['name' => 'Sound Design']);

        $response = $this->actingAs($user)->get('/tags/sound-design');

        $response->assertStatus(200);
        $response->assertSeeText('Sound Design');
        $response->assertSeeText('Update Tag');
        $response->assertSeeText('Delete Tag');
    }
}
