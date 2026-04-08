{{-- partials/nav.blade.php — Desktop Navigation --}}

<nav class="hidden lg:flex items-center gap-x-1 lg:gap-x-4">

    {{-- Anasayfa --}}
    <a href="{{ route('home') }}"
        class="px-3 py-1.5 text-[15px] transition-all duration-200 whitespace-nowrap rounded-lg active:scale-[0.98]
        {{ request()->routeIs('home')
    ? 'font-semibold text-gray-900 bg-gray-100 dark:text-white dark:bg-[#2A2A28]'
    : 'font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-[#2A2A28]' }}">
        Anasayfa
    </a>

    {{-- Haberler --}}
    <a href="{{ route('news.index') }}"
        class="px-3 py-1.5 text-[15px] transition-all duration-200 whitespace-nowrap rounded-lg active:scale-[0.98]
        {{ request()->routeIs('news.*')
    ? 'font-semibold text-gray-900 bg-gray-100 dark:text-white dark:bg-[#2A2A28]'
    : 'font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-[#2A2A28]' }}">
        Haberler
    </a>

    {{-- Miras (No Dropdown) --}}
    <a href="{{ url('/miras') }}"
        class="px-3 py-1.5 text-[15px] transition-all duration-200 whitespace-nowrap rounded-lg active:scale-[0.98]
        {{ request()->is('miras*')
    ? 'font-semibold text-gray-900 bg-gray-100 dark:text-white dark:bg-[#2A2A28]'
    : 'font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-[#2A2A28]' }}">
        Miras
    </a>

    {{-- Branşlar (No Dropdown) --}}
    <a href="{{ url('/branslar') }}"
        class="px-3 py-1.5 text-[15px] transition-all duration-200 whitespace-nowrap rounded-lg active:scale-[0.98]
        {{ request()->is('branslar*')
    ? 'font-semibold text-gray-900 bg-gray-100 dark:text-white dark:bg-[#2A2A28]'
    : 'font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-[#2A2A28]' }}">
        Branşlar
    </a>

    {{-- Maç Merkezi (No Dropdown) --}}
    <a href="{{ route('match.show') }}"
        class="px-3 py-1.5 text-[15px] transition-all duration-200 whitespace-nowrap rounded-lg active:scale-[0.98]
        {{ request()->routeIs('match.*') || request()->routeIs('standings.*')
    ? 'font-semibold text-gray-900 bg-gray-100 dark:text-white dark:bg-[#2A2A28]'
    : 'font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-[#2A2A28]' }}">
        Maç Merkezi
    </a>

    {{-- Platform Dropdown --}}
    <div class="relative group">
        <button type="button"
            class="flex items-center gap-x-1 px-3 py-1.5 text-[15px] font-medium transition-all duration-200 whitespace-nowrap rounded-lg active:scale-[0.98] text-gray-700 dark:text-gray-300 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-[#2A2A28]">
            Platform
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-3.5 h-3.5 text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300 transition-transform duration-300 group-hover:-rotate-180"
                fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
            </svg>
        </button>
        <div
            class="absolute left-1/2 -translate-x-1/2 top-full pt-2 opacity-0 translate-y-2 invisible group-hover:opacity-100 group-hover:translate-y-0 group-hover:visible transition-all duration-200 ease-out z-50">
            <div class="rounded-xl flex flex-col p-1.5 min-w-[160px]
                bg-white border border-gray-200 shadow-xl border-b-[3px] border-b-[#B32025]
                dark:bg-[#1E1E1C] dark:border-[#2A2A28] dark:shadow-black/30">

                <a href="#"
                    class="block px-3 py-2 rounded-md transition-colors duration-200 text-[14px] font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#2A2A28] hover:text-gray-900 dark:hover:text-white whitespace-nowrap">
                    Hakkımızda
                </a>
                <a href="#"
                    class="block px-3 py-2 rounded-md transition-colors duration-200 text-[14px] font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-[#2A2A28] hover:text-gray-900 dark:hover:text-white whitespace-nowrap">
                    İletişim
                </a>
            </div>
        </div>
    </div>

</nav>
