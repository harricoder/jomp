<?php

declare(strict_types=1);

namespace Tests\Feature\Manufacturers;

use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManufacturerViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_redirected_if_not_logged_in(): void
    {
        $response = $this->get('/manufacturers/big-brand');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_tag_can_be_viewed(): void
    {
        $user = User::factory()->create();
        $manufacturer = Manufacturer::factory()->create([
            'name' => 'Big Brand',
            'url' => 'https://www.big-brand.com',
            'description' => 'Big brand, selling big things.'
        ]);

        $response = $this->actingAs($user)->get('/manufacturers/big-brand');

        $response->assertStatus(200);
        $response->assertSeeText('Big Brand');
        $response->assertSeeText('URL');
        $response->assertSeeText('Big brand, selling big things.');
        $response->assertSeeText('Update Manufacturer');
        $response->assertSeeText('Delete Manufacturer');
    }
}
