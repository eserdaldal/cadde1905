<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TagController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $now = Carbon::now();
        $search = trim((string) $request->query('q', ''));

        $tag = Tag::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $items = $tag->news()
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', $now)
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($subQuery) use ($search) {
                    $subQuery
                        ->where('title', 'like', '%' . $search . '%')
                        ->orWhere('summary', 'like', '%' . $search . '%')
                        ->orWhere('content', 'like', '%' . $search . '%');
                });
            })
            ->orderByDesc('published_at')
            ->paginate(12)
            ->withQueryString();

        return view('pages.tag.show', [
            'tag' => $tag,
            'items' => $items,
            'search' => $search,
        ]);
    }
}
