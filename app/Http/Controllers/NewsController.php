<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $now = Carbon::now();
        $search = trim((string) $request->query('q', ''));

        $baseQuery = News::query()
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
            });

        $featured = (clone $baseQuery)
            ->orderByDesc('published_at')
            ->first();

        if ($featured) {
            $featured->list_excerpt = $this->makeExcerpt($featured, 220);
        }

        $items = (clone $baseQuery)
            ->when($featured, function ($query) use ($featured) {
                $query->where('id', '!=', $featured->id);
            })
            ->orderByDesc('published_at')
            ->paginate(12)
            ->withQueryString();

        $items->getCollection()->transform(function ($item) {
            $item->list_excerpt = $this->makeExcerpt($item, 150);

            return $item;
        });

        return view('pages.news.index', [
            'featured' => $featured,
            'items' => $items,
            'search' => $search,
        ]);
    }

    public function show(Request $request, string $slug)
    {
        $now = Carbon::now();

        $item = News::with('tags')
            ->where('slug', $slug)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', $now)
            ->firstOrFail();

        // İlgili Haberler (Aynı kategoriden veya son eklenenler, mevcut haber hariç)
        $relatedNews = News::query()
            ->where('id', '!=', $item->id)
            ->where('status', 'published')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', $now)
            ->when($item->category_id, function($query) use ($item) {
                // Öncelik aynı kategori, yoksa sadece tarihe göre
                $query->orderByRaw('category_id = ? DESC', [$item->category_id]);
            })
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('pages.news.show', [
            'item' => $item,
            'relatedNews' => $relatedNews,
        ]);
    }

    protected function makeExcerpt(News $item, int $limit = 160): string
    {
        $summary = trim((string) ($item->summary ?? ''));

        if ($summary !== '') {
            return Str::limit(preg_replace('/\s+/', ' ', $summary), $limit);
        }

        $content = trim(strip_tags((string) ($item->content ?? '')));

        if ($content === '') {
            return 'İçerik özeti yakında eklenecek.';
        }

        return Str::limit(preg_replace('/\s+/', ' ', $content), $limit);
    }
}
