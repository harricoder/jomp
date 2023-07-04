<?php

declare(strict_types=1);

namespace Tests\Feature\Manufacturers;

use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManufacturerDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_redirected_if_not_logged_in(): void
    {
        $manufacturer = Manufacturer::factory()->create(['name' => 'Big Brand']);
        $response = $this->delete('/manufacturers/big-brand');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_manufacturer_deleted(): void
    {
        $user = User::factory()->create();
        $manufacturer = Manufacturer::factory()->create(['name' => 'Big Brand']);

        $response = $this->actingAs($user)
            ->from('/manufacturers/big-brand')
            ->delete('/manufacturers/big-brand');

        $this->assertModelMissing($manufacturer);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302)->assertRedirect('/manufacturers');
    }
}
