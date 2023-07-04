<?php

declare(strict_types=1);

namespace Tests\Feature\Manufacturers;

use App\Models\Manufacturer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ManufacturerUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_manufacturer_update_redirects_if_user_not_logged_in(): void
    {
        $response = $this->put('/manufacturers/big-brand');

        $response->assertStatus(302)->assertRedirect('/login');
    }

    public function test_manufacturer_update_errors(): void
    {
        $user = User::factory()->create();
        Manufacturer::factory()->create([
            'name' => 'Big Brand',
            'url' => 'https://www.big-brand.com',
            'description' => 'Big brand, selling big things.'
        ]);

        $response = $this
            ->actingAs($user)
            ->from('/manufacturers/big-brand')
            ->put('/manufacturers/big-brand', ['name' => '']);

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]);
        $response->assertStatus(302)->assertRedirect('/manufacturers/big-brand');
    }

    public function test_manufacturer_updated(): void
    {
        $user = User::factory()->create();
        $manufacturer = Manufacturer::factory()->create([
            'name' => 'Big Brand',
            'url' => 'https://www.big-brand.com',
            'description' => 'Big brand, selling big things.'
        ]);

        $response = $this->actingAs($user)
            ->from('/manufacturers/big-brand')
            ->put('/manufacturers/big-brand', [
                'name' => 'Other Brand',
                'url' => 'https://www.other-brand.com',
                'description' => 'Some other brand.'
            ]);

        $manufacturer->refresh();

        $this->assertSame('Other Brand', $manufacturer->name);
        $this->assertSame('other-brand', $manufacturer->slug);
        $this->assertSame('https://www.other-brand.com', $manufacturer->url);
        $this->assertSame('Some other brand.', $manufacturer->description);

        $response->assertSessionHasNoErrors();
        $response->assertStatus(302)->assertRedirect('/manufacturers');
    }
}
