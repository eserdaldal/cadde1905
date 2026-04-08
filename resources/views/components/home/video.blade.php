@php use Illuminate\Support\Str; @endphp

@if (!empty($video))
<div class="block">
    <div class="title-section ui-section-title">Videolar</div>

    <div class="grid-3">

        @foreach ($video as $item)

            @php
                $embedUrl = null;

                if ($item->url) {

                    // youtube watch
                    if (Str::contains($item->url, 'youtube.com/watch')) {
                        parse_str(parse_url($item->url, PHP_URL_QUERY), $query);
                        $videoId = $query['v'] ?? null;

                        if ($videoId) {
                            $embedUrl = "https://www.youtube.com/embed/" . $videoId;
                        }
                    }

                    // youtu.be short
                    if (Str::contains($item->url, 'youtu.be')) {
                        $parts = explode('/', $item->url);
                        $videoId = end($parts);
                        $embedUrl = "https://www.youtube.com/embed/" . $videoId;
                    }
                }
            @endphp

            <div>

                {{-- VIDEO --}}
                @if ($embedUrl)
                    <div style="position:relative;padding-bottom:56.25%;height:0;border-radius:12px;overflow:hidden;">
                        <iframe
                            src="{{ $embedUrl }}"
                            style="position:absolute;top:0;left:0;width:100%;height:100%;border:0;"
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    {{-- FALLBACK IMAGE --}}
                    @if ($item->imageUrl)
                        <img
                            src="{{ Str::startsWith($item->imageUrl, ['http://','https://']) ? $item->imageUrl : asset('storage/'.$item->imageUrl) }}"
                            style="width:100%;height:180px;object-fit:cover;border-radius:12px;"
                        >
                    @endif
                @endif

                {{-- META --}}
                <div class="body">
                    <div class="meta">
                        @if ($item->publishedAt instanceof \Carbon\CarbonInterface)
                            {{ $item->publishedAt->format('d.m.Y') }}
                        @else
                            {{ $item->publishedAt }}
                        @endif
                    </div>

                    <div class="title">{{ $item->title }}</div>
                </div>

            </div>

        @endforeach

    </div>
</div>
@endif
