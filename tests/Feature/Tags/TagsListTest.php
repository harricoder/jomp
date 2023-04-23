<?php

declare(strict_types=1);

namespace Feature\Tags;

use App\Models\Tag;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagsListTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_redirected_if_not_logged_in(): void
    {
        $response = $this->get('/tags');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_view_page_with_no_tags(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/tags');

        $response->assertStatus(200);
        $response->assertSeeText('No Tags Available');
    }

    public function test_view_list_of_tags(): void
    {
        $user = User::factory()->create();
        Tag::factory()->create(['name' => 'Sound Design']);
        Tag::factory()->create(['name' => 'Synth']);

        $response = $this->actingAs($user)->get('/tags');

        $response->assertStatus(200);
        $response->assertSeeText('Sound Design');
        $response->assertSeeText('Synth');
    }

    public function test_tag_form_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/tags');

        $response->assertStatus(200);
        $response->assertSeeText('Tag Name');
    }
}
