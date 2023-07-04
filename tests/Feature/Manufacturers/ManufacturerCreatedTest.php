<?php

declare(strict_types=1);

namespace Tests\Feature\Manufacturers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManufacturerCreatedTest extends TestCase
{
    use RefreshDatabase;

    public function test_manufacturer_creation_redirects_if_user_not_logged_in(): void
    {
        $response = $this->post('/manufacturers');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_manufacturer_creation_errors(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->from('/manufacturers')
            ->post('/manufacturers', ['name' => '']);

        $this->assertDatabaseCount('manufacturers', 0);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
        $response->assertStatus(302)->assertRedirect('/manufacturers');
    }

    public function test_new_manufacturer_created(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->from('/manufacturers')
            ->post('/manufacturers', ['name' => 'Big Brand']);

        $this->assertDatabaseHas('manufacturers', [
            'name' => 'Big Brand',
        ]);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302)->assertRedirect('/manufacturers');
    }
}
