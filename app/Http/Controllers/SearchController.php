<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Posts;
use App\Models\Theme;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchMenu(Request $request)
{
    $query = $request->input('q');

    $menuItems = [
        ['name' => __('search.dashboard'), 'url' => route('dashboard')],
        ['name' => __('search.posts'), 'url' => route('posts.index')],
        ['name' => __('search.posts_add'), 'url' => route('posts.create')],
        ['name' => __('search.posts_categories'), 'url' => route('posts.categories.index')],
        ['name' => __('search.pages'), 'url' => route('pages.index')],
        ['name' => __('search.pages_add'), 'url' => route('pages.create')],
        ['name' => __('search.media'), 'url' => route('media.index')],
        ['name' => __('search.themes'), 'url' => route('tema.index')],
        ['name' => __('search.menus'), 'url' => route('menus.create')],
        ['name' => __('search.galleries'), 'url' => route('galleries.index')],
        ['name' => __('search.galleries_add'), 'url' => route('galleries.create')],
        ['name' => __('search.comments'), 'url' => route('comments.index')],
        ['name' => __('search.profile'), 'url' => route('profile.index')],
        ['name' => __('search.settings'), 'url' => route('settings.index')],
    ];

    $results = array_filter($menuItems, function ($item) use ($query) {
        return stripos($item['name'], $query) !== false;
    });

    return response()->json(array_values($results));
}

   public function searchPosts(Request $request)
{
    // Validasi input, hanya boleh teks tanpa file
    $validated = $request->validate([
        'q' => 'nullable|string|max:100',
    ]);

    // Cegah XSS
    $query = strip_tags($validated['q'] ?? '');

    // Escape wildcard LIKE
    $safeQuery = addcslashes($query, '%_');

    // Mencegah file upload
    if ($request->hasFile(null) || $request->files->count() > 0) {
        abort(400, 'File upload tidak diperbolehkan.');
    }

    // Query
    if (!empty($safeQuery)) {
        $posts = Posts::where(function ($q) use ($safeQuery) {
            $q->where('title', 'LIKE', "%{$safeQuery}%")
              ->orWhere('content', 'LIKE', "%{$safeQuery}%");
        })->paginate(10);

        $pages = Page::where(function ($q) use ($safeQuery) {
            $q->where('title', 'LIKE', "%{$safeQuery}%")
              ->orWhere('content', 'LIKE', "%{$safeQuery}%");
        })->paginate(10);
    } else {
        $posts = collect([]);
        $pages = collect([]);
    }

    $theme = Theme::where('active', true)->firstOrFail()->path;
    return view($theme . '.search', compact('posts', 'pages', 'query'));
}


    
}
