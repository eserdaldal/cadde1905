{{--
    ══════════════════════════════════════════════════════════════
    CADDE1905 — World Cup Section Layout

    Bu layout, CADDE1905 ana site layout'unu extend eder ve
    yalnızca Dünya Kupası bölümüne özgü elemanları ekler.

    ENTEGRASYON NOTLARI:
    1. Aşağıdaki @extends satırı projenizin ana layout adını referans eder.
       Eğer ana layout dosyanız "layouts.app" değilse (örn. layouts.main,
       layouts.master), bu satırı güncelleyin.
    2. Ana layout'unuzda şu satırlar olmalıdır:
       - <head> içinde: @stack('styles')
       - </body> öncesinde: @stack('scripts')
       - body içinde: @yield('content')
    3. Detaylar için INSTALL_MAP.md Bölüm 2.7'ye bakınız.
    ══════════════════════════════════════════════════════════════
--}}

@extends('layouts.app')

@section('content')

    <div class="world-cup-section">
        {{-- Dünya Kupası accent şeridi — header altında ince gradient --}}
        <div class="h-1 w-full bg-gradient-to-r from-[#8D1B3D] via-[#D4AF37] to-[#1D6F42]"></div>

        {{-- Yatay alt navigasyon (sidebar yok) --}}
        @include('worldcup.partials.subnav')

        {{-- Sayfa içeriği — her alt sayfa buraya enjekte eder --}}
        <main class="min-h-screen">
            @yield('worldcup-content')
        </main>
    </div>

@endsection
