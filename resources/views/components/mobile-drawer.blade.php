<div id="sidebar-container" class="fixed inset-0 hidden lg:hidden isolate" style="z-index: 9998;" aria-hidden="true">
    <div id="sidebar-overlay" class="absolute inset-0 bg-black/60 opacity-0 transition-opacity duration-300 ease-out"
        style="z-index: 9998;"></div>

    <aside id="sidebar-panel"
        class="fixed inset-y-0 left-0 flex h-screen w-[88%] max-w-sm -translate-x-full transform flex-col overflow-hidden border-r border-gray-200 bg-white shadow-2xl transition-transform duration-300 ease-out dark:border-[#2A2A28] dark:bg-[#161615]"
        style="z-index: 9999;" aria-label="Mobil menü">
        <div class="flex h-screen min-h-0 flex-col bg-white dark:bg-[#161615]">
            <div
                class="flex shrink-0 items-center justify-between border-b border-gray-200 px-4 py-4 dark:border-[#2A2A28]">
                <a href="{{ route('home') }}" class="-m-1.5 block p-1.5">
                    <img class="h-9 w-auto" src="{{ asset('images/logo.svg') }}" alt="CADDE1905">
                </a>

                <button id="sidebar-close" type="button"
                    class="rounded-md p-2 text-gray-500 transition-colors hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
                    aria-label="Menüyü kapat">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                        aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="shrink-0 border-b border-gray-200 px-4 py-4 dark:border-[#2A2A28]">
                <form action="{{ route('news.index') }}" method="GET">
                    <input type="text" name="q" placeholder="Haberlerde ara..." autocomplete="off"
                        class="w-full rounded-xl border border-gray-300 bg-gray-100 px-3 py-2.5 text-sm text-black placeholder-gray-500 transition-colors focus:border-[#A91D35] focus:outline-none dark:border-[#333] dark:bg-[#1A1A19] dark:text-white dark:placeholder-gray-400 dark:focus:border-[#A91D35]">
                </form>
            </div>

            <nav class="min-h-0 flex-1 overflow-y-auto px-3 py-3"
                style="overscroll-behavior-y: contain; touch-action: pan-y;">
                <div class="space-y-1 pb-6">
                    <a href="{{ route('home') }}"
                        class="block rounded-xl px-3 py-3 text-[15px] transition-colors {{ request()->routeIs('home') ? 'bg-gray-100 font-semibold text-gray-900 dark:bg-[#2A2A28] dark:text-white' : 'font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white' }}">
                        Anasayfa
                    </a>

                    <a href="{{ route('news.index') }}"
                        class="block rounded-xl px-3 py-3 text-[15px] transition-colors {{ request()->routeIs('news.*') ? 'bg-gray-100 font-semibold text-gray-900 dark:bg-[#2A2A28] dark:text-white' : 'font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white' }}">
                        Haberler
                    </a>

                    <a href="{{ url('/miras') }}"
                        class="block rounded-xl px-3 py-3 text-[15px] transition-colors {{ request()->is('miras*') ? 'bg-gray-100 font-semibold text-gray-900 dark:bg-[#2A2A28] dark:text-white' : 'font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white' }}">
                        Miras
                    </a>

                    <div
                        class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-[#2A2A28] dark:bg-[#161615]">
                        <button type="button"
                            class="flex w-full items-center justify-between px-3 py-3 text-left text-[15px] font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-[#1E1E1C]"
                            data-mobile-accordion-button data-target="mobile-accordion-branslar" aria-expanded="false"
                            aria-controls="mobile-accordion-branslar">
                            <span>Branşlar</span>
                            <svg class="h-4 w-4 shrink-0 transition-transform duration-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" data-mobile-accordion-icon
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="mobile-accordion-branslar"
                            class="hidden border-t border-gray-200 dark:border-[#2A2A28]" data-mobile-accordion-panel>
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-3 text-[14px] font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white">
                                    Futbol
                                </a>
                                <a href="#"
                                    class="block px-4 py-3 text-[14px] font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white">
                                    Basketbol Erkek
                                </a>
                                <a href="#"
                                    class="block px-4 py-3 text-[14px] font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white">
                                    Basketbol Kadın
                                </a>
                                <a href="#"
                                    class="block px-4 py-3 text-[14px] font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white">
                                    Voleybol Erkek
                                </a>
                                <a href="#"
                                    class="block px-4 py-3 text-[14px] font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white">
                                    Voleybol Kadın
                                </a>
                            </div>
                        </div>
                    </div>

                    <div
                        class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-[#2A2A28] dark:bg-[#161615]">
                        <button type="button"
                            class="flex w-full items-center justify-between px-3 py-3 text-left text-[15px] transition-colors {{ request()->routeIs('match.*') || request()->routeIs('standings.*') ? 'bg-gray-100 font-semibold text-gray-900 dark:bg-[#2A2A28] dark:text-white' : 'font-medium text-gray-700 hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-[#1E1E1C]' }}"
                            data-mobile-accordion-button data-target="mobile-accordion-match" aria-expanded="false"
                            aria-controls="mobile-accordion-match">
                            <span>Maç Merkezi</span>
                            <svg class="h-4 w-4 shrink-0 transition-transform duration-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" data-mobile-accordion-icon
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="mobile-accordion-match" class="hidden border-t border-gray-200 dark:border-[#2A2A28]"
                            data-mobile-accordion-panel>
                            <div class="py-1">
                                <a href="{{ route('match.show') }}"
                                    class="block px-4 py-3 text-[14px] transition-colors {{ request()->routeIs('match.*') ? 'bg-gray-100 font-semibold text-gray-900 dark:bg-[#2A2A28] dark:text-white' : 'font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white' }}">
                                    Maç Merkezi
                                </a>
                                <a href="{{ route('standings.index') }}"
                                    class="block px-4 py-3 text-[14px] transition-colors {{ request()->routeIs('standings.*') ? 'bg-gray-100 font-semibold text-gray-900 dark:bg-[#2A2A28] dark:text-white' : 'font-medium text-gray-700 hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white' }}">
                                    Puan Durumu
                                </a>
                                <span
                                    class="block select-none px-4 py-3 text-[14px] font-medium text-gray-400 dark:text-gray-500">
                                    Fikstür (Yakında)
                                </span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="overflow-hidden rounded-2xl border border-gray-200 bg-white dark:border-[#2A2A28] dark:bg-[#161615]">
                        <button type="button"
                            class="flex w-full items-center justify-between px-3 py-3 text-left text-[15px] font-medium text-gray-700 transition-colors hover:bg-gray-50 dark:text-gray-300 dark:hover:bg-[#1E1E1C]"
                            data-mobile-accordion-button data-target="mobile-accordion-platform" aria-expanded="false"
                            aria-controls="mobile-accordion-platform">
                            <span>Platform</span>
                            <svg class="h-4 w-4 shrink-0 transition-transform duration-200" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" data-mobile-accordion-icon
                                aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <div id="mobile-accordion-platform"
                            class="hidden border-t border-gray-200 dark:border-[#2A2A28]" data-mobile-accordion-panel>
                            <div class="py-1">
                                <a href="#"
                                    class="block px-4 py-3 text-[14px] font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white">
                                    Hakkımızda
                                </a>
                                <a href="#"
                                    class="block px-4 py-3 text-[14px] font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white">
                                    İletişim
                                </a>
                                <a href="#"
                                    class="block px-4 py-3 text-[14px] font-medium text-gray-700 transition-colors hover:bg-gray-100 hover:text-gray-900 dark:text-gray-300 dark:hover:bg-[#2A2A28] dark:hover:text-white">
                                    Yasal Alanlar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </aside>
</div>
