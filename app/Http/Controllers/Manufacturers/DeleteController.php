<?php

declare(strict_types=1);

namespace App\Http\Controllers\Manufacturers;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(Request $request, Manufacturer $manufacturer): RedirectResponse
    {
        $manufacturer->delete();

        return redirect()->route('manufacturers')
            ->with('success', "Manufacturer {$manufacturer->slug} deleted successfully.");
    }
}
