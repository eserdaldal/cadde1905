<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CategoryController extends Controller
{
    public function show(Request $request, string $slug)
    {
        $now = Carbon::now();
        $search = trim((string) $request->query('q', ''));

        $category = Category::query()
            ->where('slug', $slug)
            ->firstOrFail();

        $items = News::query()
            ->where('category_id', $category->id)
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

        return view('pages.category.show', [
            'category' => $category,
            'items' => $items,
            'search' => $search,
        ]);
    }
}