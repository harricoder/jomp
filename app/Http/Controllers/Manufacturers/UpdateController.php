<?php

declare(strict_types=1);

namespace App\Http\Controllers\Manufacturers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manufacturers\UpdateRequest as UpdateManufacturerRequest;
use App\Models\Manufacturer;
use Illuminate\Http\RedirectResponse;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateManufacturerRequest $request, Manufacturer $manufacturer): RedirectResponse
    {
        $manufacturer->update($request->validated());

        return redirect()->route('manufacturers')
            ->with('success', "Manufacturer {$manufacturer->slug} updated successfully.");
    }
}
