<?php

declare(strict_types=1);

namespace App\Http\Controllers\Manufacturers;

use App\Http\Controllers\Controller;
use App\Models\Manufacturer;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(Request $request): View
    {
        return view('manufacturers.index', ['manufacturers' => Manufacturer::all()->sortBy('slug')]);
    }
}
