<header class="w-full psl-header sticky top-0 z-40 shadow-sm dark:shadow-none transition-colors duration-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 grid items-center psl-header-grid">

        {{-- Logo (sol — sabit genişlik denge sağlar) --}}
        <div class="flex items-center psl-header-logo">
            <a href="{{ route('home') }}" class="block">
                <img src="{{ asset('images/logo.svg') }}" alt="CADDE1905" class="h-10 w-auto">
            </a>
        </div>

        {{-- Desktop Navigation (orta, merkez hizalı) --}}
        <div class="hidden lg:flex justify-center">
            @include('partials.nav')
        </div>
        {{-- Mobil boş orta kolon --}}
        <div class="flex lg:hidden"></div>

        {{-- Sağ Alan — sabit genişlik, nav kaymayı önler --}}
        <div class="flex items-center justify-end gap-x-1 w-[240px]">

            {{-- Mobil Menü Butonu --}}
            <button id="sidebar-open" type="button"
                class="flex lg:hidden p-2 text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 rounded-md transition-colors">
                <svg class="psl-header-icon-24" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            {{-- Arama: gizli input + toggle butonu --}}
            <div class="flex items-center gap-x-1">
                <div id="search-box" class="flex items-center psl-search-box">
                    <form action="{{ route('search.index') }}" method="GET" class="flex items-center">
                        <input id="search-input" type="text" name="q" value="{{ request('q') }}" placeholder="Ara..." autocomplete="off" onfocus="if(!this.dataset.cleared){this.dataset.cleared='1';this.value='';}"
                            class="w-44 px-3 py-1.5 text-sm rounded-lg border border-[var(--border-default)] bg-[var(--surface-card)] text-[var(--text-primary)] placeholder-[var(--text-muted)] focus:outline-none focus:border-[var(--accent-primary)] transition-colors">
                    </form>
                </div>
                {{-- INLINE_OK: dynamic search box visibility toggle --}}
                <button type="button"
                    onclick="(function(){var b=document.getElementById('search-box');var isHidden=b.style.display==='none'||b.style.display==='';b.style.display=isHidden?'flex':'none';if(isHidden)setTimeout(function(){document.getElementById('search-input').focus();},50);})()"
                    class="p-2 text-gray-500 hover:text-black dark:text-gray-400 dark:hover:text-white rounded-md transition-colors"
                    aria-label="Ara">
                    <svg class="psl-header-icon-20" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </button>
            </div>

            {{-- Theme Toggle --}}
            <button id="theme-toggle" type="button"
                class="p-2 text-gray-500 hover:text-black dark:text-gray-400 dark:hover:text-white rounded-md transition-colors"
                aria-label="Toggle dark mode">
                <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z">
                    </path>
                </svg>
                <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                </svg>
            </button>

        </div>

    </div>
</header>
