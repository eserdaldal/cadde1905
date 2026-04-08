<x-filament-widgets::widget>
    <x-filament::section>
        <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px;">
            <div style="display:flex; align-items:center; gap:16px;">
                <div style="width:48px; height:48px; border-radius:50%; background:rgba(245,158,11,0.15); border:1px solid rgba(245,158,11,0.3); display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                    <span style="font-size:1.4rem;">📋</span>
                </div>
                <div>
                    <div style="font-size:0.75rem; font-weight:700; text-transform:uppercase; letter-spacing:0.1em; color:rgb(245,158,11); margin-bottom:4px;">
                        Editöryal Standartlar
                    </div>
                    <div style="font-size:1rem; font-weight:700; color:var(--fi-color-gray-950, #0f172a);" class="dark:text-white">
                        İçerik DNA Rehberi
                    </div>
                    <div style="font-size:0.82rem; color:var(--fi-color-gray-500, #64748b); margin-top:3px;">
                        Yazar ve editörler için içerik kalitesi, ton ve yapı standartları kılavuzu.
                    </div>
                </div>
            </div>

            <a
                href="{{ url('/platform/icerik-rehberi') }}"
                target="_blank"
                style="display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border-radius:8px; background:rgb(245,158,11); color:#000; font-size:0.82rem; font-weight:700; text-decoration:none; white-space:nowrap; transition:background 0.2s;"
                onmouseover="this.style.background='rgb(217,119,6)'"
                onmouseout="this.style.background='rgb(245,158,11)'"
            >
                İçerik Rehberini Aç
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                </svg>
            </a>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
