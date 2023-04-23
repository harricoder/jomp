<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ListController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): View
    {
        return view('tags.index', ['tags' => Tag::all()->sortBy('slug')]);
    }
}
