{{--
    CADDE1905 — World Cup Sub-Navigation
    Yalnızca /dunya-kupasi/* sayfalarında görünür.
    Ana header'ın altında, yatay navigasyon barı.
--}}

<nav class="bg-[#1E1E1C] border-b border-white/10 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-1 overflow-x-auto scrollbar-hide py-0">

            {{-- Logo / Bölüm Başlığı --}}
            @php
                $activeTournament = $activeTournament ?? null;
                $navTitle = $activeTournament?->name;

                if (! $navTitle) {
                    $navTitle = $activeTournament?->year ? ('Dünya Kupası ' . $activeTournament->year) : 'Dünya Kupası';
                }
            @endphp

            <a href="{{ route('worldcup.index') }}"
               class="flex-shrink-0 flex items-center gap-2 pr-4 mr-2 border-r border-white/10">
                <span class="text-[#D4AF37] text-lg">🏆</span>
                <span class="text-white font-bold text-sm tracking-wide whitespace-nowrap">
                    {{ mb_strtoupper($navTitle, 'UTF-8') }}
                </span>
            </a>

            {{-- Navigasyon Linkleri --}}
            @php
                $wcNav = [
                    ['route' => 'worldcup.index',          'label' => 'Genel Bakış',       'exact' => true],
                    ['route' => 'worldcup.teams.index',    'label' => 'Takımlar'],
                    ['route' => 'worldcup.matches.index',  'label' => 'Maçlar'],
                    ['route' => 'worldcup.groups.index',   'label' => 'Gruplar'],
                    ['route' => 'worldcup.stats.index',    'label' => 'İstatistikler'],
                    ['route' => 'worldcup.stadiums.index', 'label' => 'Stadyumlar'],
                    ['route' => 'worldcup.aslanlar.index', 'label' => 'Kupadaki Aslanlar', 'special' => true],
                ];
            @endphp

            @foreach ($wcNav as $item)
                @php
                    $isExact   = $item['exact'] ?? false;
                    $isSpecial = $item['special'] ?? false;

                    // DÜZELTİLDİ: Index için strict match, diğerleri wildcard.
                    // Eski hali worldcup.index* wildcard'ı tüm sayfalarda eşleşiyordu.
                    $isActive = $isExact
                        ? request()->routeIs($item['route'])
                        : request()->routeIs($item['route']) || request()->routeIs(
                              str_replace('.index', '.*', $item['route'])
                          );
                @endphp

                <a href="{{ route($item['route']) }}"
                   class="relative flex items-center gap-1.5 px-3 py-3 text-sm font-medium whitespace-nowrap transition-colors duration-200
                          {{ $isActive
                              ? 'text-white'
                              : 'text-gray-400 hover:text-white' }}
                          {{ $isSpecial && !$isActive
                              ? 'text-[#D4AF37] hover:text-[#D4AF37]'
                              : '' }}
                   ">
                    @if ($isSpecial)
                        <span class="text-[#D4AF37] text-xs">🦁</span>
                    @endif

                    {{ $item['label'] }}

                    @if ($isActive)
                        <span class="absolute bottom-0 left-3 right-3 h-0.5 rounded-full
                                     {{ $isSpecial ? 'bg-[#D4AF37]' : 'bg-[#8D1B3D]' }}">
                        </span>
                    @endif
                </a>
            @endforeach

        </div>
    </div>
</nav>
