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
    {{-- Maç Merkezi (No Dropdown) --}}
    <a href="{{ route('match.show') }}"
        class="px-3 py-1.5 text-[15px] transition-all duration-200 whitespace-nowrap rounded-lg active:scale-[0.98]
        {{ request()->routeIs('match.*') || request()->routeIs('standings.*')
    ? 'font-semibold text-gray-900 bg-gray-100 dark:text-white dark:bg-[#2A2A28]'
    : 'font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-[#2A2A28]' }}">
        Maç Merkezi
    </a>

    {{-- Platform (Single Link) --}}
    <a href="{{ route('platform.index') }}"
        class="px-3 py-1.5 text-[15px] transition-all duration-200 whitespace-nowrap rounded-lg active:scale-[0.98]
        {{ request()->routeIs('platform.*')
    ? 'font-semibold text-gray-900 bg-gray-100 dark:text-white dark:bg-[#2A2A28]'
    : 'font-medium text-gray-700 dark:text-gray-300 hover:text-gray-900 hover:bg-gray-100 dark:hover:text-white dark:hover:bg-[#2A2A28]' }}">
        Platform
    </a>

</nav>
