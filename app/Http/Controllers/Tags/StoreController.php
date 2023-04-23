<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tags\StoreRequest as StoreTagRequest;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(StoreTagRequest $request): RedirectResponse
    {
        $tag = Tag::create($request->validated());

        return redirect()->route('tags')
            ->with('success', "Tag {$tag->slug} created successfully.");
    }
}
