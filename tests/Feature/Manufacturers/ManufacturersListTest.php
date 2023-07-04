<?php

declare(strict_types=1);

namespace Tests\Feature\Manufacturers;

use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManufacturersListTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_redirected_if_not_logged_in(): void
    {
        $response = $this->get('/manufacturers');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_view_page_with_no_manufacturers(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/manufacturers');

        $response->assertStatus(200);
        $response->assertSeeText('No Manufacturers Available');
    }

    public function test_view_list_of_manufacturers(): void
    {
        $user = User::factory()->create();
        Manufacturer::factory()->create(['name' => 'Bass']);
        Manufacturer::factory()->create(['name' => 'Vocal']);

        $response = $this->actingAs($user)->get('/manufacturers');

        $response->assertStatus(200);
        $response->assertSeeText('Bass');
        $response->assertSeeText('Vocal');
    }

    public function test_manufacturer_form_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/manufacturers');

        $response->assertStatus(200);
        $response->assertSeeText('Manufacturer Name');
    }
}
