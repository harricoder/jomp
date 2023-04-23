<?php

declare(strict_types=1);

namespace App\Http\Controllers\Tags;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __invoke(Request $request, Tag $tag): RedirectResponse
    {
        $tag->delete();

        return redirect()->route('tags')
            ->with('success', "Tag {$tag->slug} deleted successfully.");
    }
}
