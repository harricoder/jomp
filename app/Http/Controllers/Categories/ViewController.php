<?php

declare(strict_types=1);

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ViewController extends Controller
{
    /**
     * Handle the incoming request.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(Request $request, Category $category): View
    {
        return view('categories.edit', ['category' => $category]);
    }
}
