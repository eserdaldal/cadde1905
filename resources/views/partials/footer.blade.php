<footer class="psl-footer py-8 px-4 sm:px-6 lg:px-8 mt-auto transition-colors duration-200">
    <div class="max-w-7xl mx-auto flex flex-col gap-6">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-6">
            <div class="text-center lg:text-left lg:max-w-md shrink-0">
                <span class="text-xl font-extrabold text-[#A91D35] tracking-tight block">CADDE1905</span>
                <p class="mt-3 text-sm text-gray-500 dark:text-gray-400 leading-6">
                    Galatasaray'ın en köklü taraftar oluşumu.<br>
                    Sarı ve kırmızıya adanmış hayatlar.
                </p>
            </div>

            <div class="flex flex-wrap items-center justify-center lg:justify-end gap-x-6 gap-y-3 text-sm lg:max-w-3xl">
                <a href="{{ route('platform.index') }}"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                    Platform
                </a>
                <a href="{{ route('platform.about') }}"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                    Hakkımızda
                </a>
                <a href="{{ route('platform.contact') }}"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                    İletişim
                </a>
                <a href="{{ route('platform.privacy') }}"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                    Gizlilik Politikası
                </a>
                <a href="{{ route('platform.terms') }}"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                    Kullanım Şartları
                </a>
                <a href="{{ route('platform.kvkk') }}"
                    class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                    KVKK
                </a>
            </div>
        </div>

        <div class="border-t border-gray-200 dark:border-[var(--border)] pt-5 text-center text-xs text-gray-500 dark:text-[var(--muted)] opacity-80">
            <p>&copy; {{ date('Y') }} Cadde1905. Tüm hakları saklıdır.</p>
        </div>
    </div>
</footer>
