<?php

declare(strict_types=1);

namespace Feature\Tags;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_redirected_if_not_logged_in(): void
    {
        $response = $this->delete('/tags/synth');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_tag_deleted(): void
    {
        $user = User::factory()->create();
        $tag = Tag::factory()->create(['name' => 'Synth']);

        $response = $this->actingAs($user)->from('/tags/synth')->delete('/tags/synth');

        $this->assertModelMissing($tag);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302)->assertRedirect('/tags');
    }
}
