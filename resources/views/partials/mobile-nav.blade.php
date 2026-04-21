<div id="sidebar-container" class="hidden lg:hidden fixed inset-0 z-50">
    <div
        id="sidebar-overlay"
        class="absolute inset-0 bg-black/60 opacity-0 transition-opacity duration-300"
        aria-hidden="true"
    ></div>

    <aside
        id="sidebar-panel"
        class="absolute right-0 top-0 h-full w-[84vw] max-w-[320px] translate-x-full bg-[#161615] border-l border-[#2A2A2A] shadow-2xl transition-transform duration-300 overflow-y-auto"
        aria-label="Mobil navigasyon"
        aria-hidden="true"
    >
        <div class="flex items-center justify-between px-4 h-16 border-b border-[#2A2A2A]">
            <a href="{{ route('home') }}" class="block">
                <img class="h-8 w-auto" src="{{ asset('images/logo.svg') }}" alt="CADDE1905">
            </a>

            <button
                id="sidebar-close"
                type="button"
                class="p-2 text-gray-400 hover:text-white rounded-md transition-colors"
                aria-label="Menüyü kapat"
            >
                <span class="text-xl leading-none">×</span>
            </button>
        </div>

        <nav class="px-4 py-4">
            <div class="flex flex-col gap-y-2">
                <a
                    href="{{ route('home') }}"
                    class="rounded-xl px-3 py-3 text-sm font-semibold text-white hover:bg-[#1F1F1F] transition-colors"
                >
                    Anasayfa
                </a>

                <a
                    href="{{ route('news.index') }}"
                    class="rounded-xl px-3 py-3 text-sm font-semibold text-white hover:bg-[#1F1F1F] transition-colors"
                >
                    Haberler
                </a>

                <div class="rounded-2xl border border-[#2A2A2A] overflow-hidden">
                    <button
                        type="button"
                        class="mobile-accordion-toggle w-full flex items-center justify-between px-3 py-3 text-left text-sm font-semibold text-white bg-transparent hover:bg-[#1F1F1F] transition-colors"
                        data-target="mobile-sub-match"
                        aria-expanded="false"
                    >
                        <span>Maç Merkezi</span>
                        <span class="mobile-accordion-icon text-base leading-none">⌄</span>
                    </button>

                    <div id="mobile-sub-match" class="hidden border-t border-[#2A2A2A] bg-[#121212]">
                        <div class="flex flex-col p-2">
                            <a
                                href="{{ route('match.show') }}"
                                class="rounded-lg px-3 py-2.5 text-sm text-gray-200 hover:bg-[#1A1A1A] transition-colors"
                            >
                                Maç Merkezi
                            </a>
                            <a
                                href="{{ route('standings.index') }}"
                                class="rounded-lg px-3 py-2.5 text-sm text-gray-200 hover:bg-[#1A1A1A] transition-colors"
                            >
                                Puan Durumu
                            </a>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-[#2A2A2A] overflow-hidden">
                    <button
                        type="button"
                        class="mobile-accordion-toggle w-full flex items-center justify-between px-3 py-3 text-left text-sm font-semibold text-white bg-transparent hover:bg-[#1F1F1F] transition-colors"
                        data-target="mobile-sub-heritage"
                        aria-expanded="false"
                    >
                        <span>Miras</span>
                        <span class="mobile-accordion-icon text-base leading-none">⌄</span>
                    </button>

                    <div id="mobile-sub-heritage" class="hidden border-t border-[#2A2A2A] bg-[#121212]">
                        <div class="flex flex-col p-2">
                            <span class="rounded-lg px-3 py-2.5 text-sm text-gray-500 cursor-not-allowed">Kulüp Tarihi (yakında)</span>
                            <span class="rounded-lg px-3 py-2.5 text-sm text-gray-500 cursor-not-allowed">Efsane Anlar (yakında)</span>
                            <span class="rounded-lg px-3 py-2.5 text-sm text-gray-500 cursor-not-allowed">Tarihte Bugün (yakında)</span>
                        </div>
                    </div>
                </div>

                

                <div class="rounded-2xl border border-[#2A2A2A] overflow-hidden">
                    <button
                        type="button"
                        class="mobile-accordion-toggle w-full flex items-center justify-between px-3 py-3 text-left text-sm font-semibold text-white bg-transparent hover:bg-[#1F1F1F] transition-colors"
                        data-target="mobile-sub-platform"
                        aria-expanded="false"
                    >
                        <span>Platform</span>
                        <span class="mobile-accordion-icon text-base leading-none">⌄</span>
                    </button>

                    <div id="mobile-sub-platform" class="hidden border-t border-[#2A2A2A] bg-[#121212]">
                        <div class="flex flex-col p-2">
                            <span class="rounded-lg px-3 py-2.5 text-sm text-gray-500 cursor-not-allowed">Cadde1905 Nedir? (yakında)</span>
                            <span class="rounded-lg px-3 py-2.5 text-sm text-gray-500 cursor-not-allowed">Topluluk (yakında)</span>
                            <span class="rounded-lg px-3 py-2.5 text-sm text-gray-500 cursor-not-allowed">İletişim (yakında)</span>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </aside>
</div>