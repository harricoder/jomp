<?php

declare(strict_types=1);

namespace App\Http\Controllers\Manufacturers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manufacturers\StoreRequest as StoreManufacturerRequest;
use App\Models\Manufacturer;
use Illuminate\Http\RedirectResponse;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreManufacturerRequest $request): RedirectResponse
    {
        $manufacturer = Manufacturer::create($request->validated());

        return redirect()->route('manufacturers')
            ->with('success', "Manufacturer {$manufacturer->slug} created successfully.");
    }
}
