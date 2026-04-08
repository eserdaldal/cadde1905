<!DOCTYPE html>
<html lang="tr" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Cadde1905') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/logo.svg') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/logo.svg') }}">

    <!-- Manrope Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">

    @php
        $siteThemeMode = 'dark';
        try {
            $configuredThemeMode = \Illuminate\Support\Facades\DB::table('settings')
                ->where('key', 'theme_mode')
                ->value('value');

            if (in_array($configuredThemeMode, ['dark', 'light', 'system'], true)) {
                $siteThemeMode = $configuredThemeMode;
            }
        } catch (\Throwable $e) {
            $siteThemeMode = 'dark';
        }
    @endphp

    <script>
        (function () {
            var storageKey = 'theme';
            var fallbackMode = 'dark';
            var allowedModes = { dark: true, light: true, system: true };
            var siteMode = @js($siteThemeMode);
            siteMode = allowedModes[siteMode] ? siteMode : fallbackMode;
            var mode = siteMode;

            function resolveTheme(inputMode) {
                if (inputMode === 'system') {
                    try {
                        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
                            ? 'dark'
                            : 'light';
                    } catch (e) {
                        return fallbackMode;
                    }
                }

                return inputMode === 'light' ? 'light' : 'dark';
            }

            try {
                var stored = localStorage.getItem(storageKey);
                if (allowedModes[stored]) {
                    mode = stored;
                } else if (stored !== null) {
                    localStorage.removeItem(storageKey);
                }
            } catch (e) {
                mode = siteMode;
            }

            var resolvedTheme = resolveTheme(mode);

            var root = document.documentElement;
            root.dataset.siteThemeMode = siteMode;
            root.dataset.themeMode = mode;
            root.dataset.theme = resolvedTheme;
            root.classList.remove('light', 'dark');
            root.classList.add(resolvedTheme);
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    @include('partials.header')
    @include('components.mobile-drawer')

    <main class="page {{ request()->routeIs('worldcup.*') ? 'is-worldcup' : '' }}">
        @hasSection('page-header')
            <div class="page-header">
                @yield('page-header')
            </div>
        @endif
        <div class="main-grid {{ request()->routeIs('worldcup.*') ? 'is-worldcup' : '' }}">
            <div class="content-area min-w-0">
                @yield('content')
            </div>
            @if(!request()->routeIs('worldcup.*'))
                <aside class="sidebar-area">
                    @include('components.sidebar')
                </aside>
            @endif
        </div>
    </main>

    @include('partials.footer')
    @stack('scripts')
</body>

</html>
