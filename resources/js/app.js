import './bootstrap';

const THEME_STORAGE_KEY = 'theme';
const FALLBACK_THEME_MODE = 'dark';
const ALLOWED_THEME_MODES = new Set(['dark', 'light', 'system']);

function normalizeThemeMode(mode) {
    return typeof mode === 'string' && ALLOWED_THEME_MODES.has(mode) ? mode : null;
}

function getSiteThemeMode() {
    const siteMode = document.documentElement.dataset.siteThemeMode;
    return normalizeThemeMode(siteMode) ?? FALLBACK_THEME_MODE;
}

function getStoredThemeMode() {
    try {
        const storedMode = localStorage.getItem(THEME_STORAGE_KEY);
        const normalizedMode = normalizeThemeMode(storedMode);

        if (storedMode !== null && normalizedMode === null) {
            localStorage.removeItem(THEME_STORAGE_KEY);
        }

        return normalizedMode;
    } catch (error) {
        return null;
    }
}

function resolveTheme(mode) {
    if (mode === 'system') {
        try {
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        } catch (error) {
            return FALLBACK_THEME_MODE;
        }
    }

    return mode === 'light' ? 'light' : 'dark';
}

function resolvePreferredMode() {
    return getStoredThemeMode() ?? getSiteThemeMode() ?? FALLBACK_THEME_MODE;
}

function syncThemeToggleIcons(resolvedTheme) {
    const lightIcon = document.getElementById('theme-toggle-light-icon');
    const darkIcon = document.getElementById('theme-toggle-dark-icon');

    if (!lightIcon || !darkIcon) {
        return;
    }

    if (resolvedTheme === 'dark') {
        lightIcon.classList.remove('hidden');
        darkIcon.classList.add('hidden');
        return;
    }

    darkIcon.classList.remove('hidden');
    lightIcon.classList.add('hidden');
}

function applyThemeMode(mode, options = {}) {
    const persist = options.persist === true;
    const normalizedMode = normalizeThemeMode(mode) ?? resolvePreferredMode();
    const resolvedTheme = resolveTheme(normalizedMode);
    const root = document.documentElement;

    root.dataset.themeMode = normalizedMode;
    root.dataset.theme = resolvedTheme;
    root.classList.remove('light', 'dark');
    root.classList.add(resolvedTheme);

    if (persist) {
        try {
            localStorage.setItem(THEME_STORAGE_KEY, normalizedMode);
        } catch (error) {
            // Ignore storage errors to preserve runtime behavior.
        }
    }

    syncThemeToggleIcons(resolvedTheme);

    return {
        mode: normalizedMode,
        theme: resolvedTheme,
    };
}

function getNextThemeMode(currentMode) {
    if (currentMode === 'dark') {
        return 'light';
    }

    if (currentMode === 'light') {
        return 'system';
    }

    return 'dark';
}

function bindThemeToggle() {
    const toggle = document.getElementById('theme-toggle');

    if (!toggle || toggle.dataset.themeBound === '1') {
        return;
    }

    toggle.dataset.themeBound = '1';

    toggle.addEventListener('click', () => {
        const currentMode = normalizeThemeMode(document.documentElement.dataset.themeMode) ?? resolvePreferredMode();
        const nextMode = getNextThemeMode(currentMode);
        const state = applyThemeMode(nextMode, { persist: true });
        toggle.setAttribute('aria-label', `Tema modu: ${state.mode}`);
    });

    const initialState = applyThemeMode(normalizeThemeMode(document.documentElement.dataset.themeMode) ?? resolvePreferredMode());
    toggle.setAttribute('aria-label', `Tema modu: ${initialState.mode}`);
}

function bindSystemPreferenceListener() {
    let mediaQuery;

    try {
        mediaQuery = window.matchMedia('(prefers-color-scheme: dark)');
    } catch (error) {
        return;
    }

    const handleChange = () => {
        const activeMode = normalizeThemeMode(document.documentElement.dataset.themeMode) ?? resolvePreferredMode();

        if (activeMode === 'system') {
            applyThemeMode('system');
        }
    };

    if (typeof mediaQuery.addEventListener === 'function') {
        mediaQuery.addEventListener('change', handleChange);
        return;
    }

    if (typeof mediaQuery.addListener === 'function') {
        mediaQuery.addListener(handleChange);
    }
}

function initializeThemeControl() {
    applyThemeMode(resolvePreferredMode());
    bindThemeToggle();
    bindSystemPreferenceListener();
}

function initializeMobileDrawer() {
    const container = document.getElementById('sidebar-container');

    if (!container || container.dataset.mobileDrawerBound === '1') {
        return;
    }

    container.dataset.mobileDrawerBound = '1';

    const openButton = document.getElementById('sidebar-open');
    const closeButton = document.getElementById('sidebar-close');
    const overlay = document.getElementById('sidebar-overlay');
    const panel = document.getElementById('sidebar-panel');

    if (!openButton || !closeButton || !overlay || !panel) {
        return;
    }

    const transitionDurationMs = 320;
    let closeTimer = null;
    let isOpen = false;

    const setContainerState = (open) => {
        container.setAttribute('aria-hidden', open ? 'false' : 'true');
        panel.setAttribute('aria-hidden', open ? 'false' : 'true');
    };

    const lockBodyScroll = () => {
        document.body.classList.add('drawer-open');
    };

    const unlockBodyScroll = () => {
        document.body.classList.remove('drawer-open');
    };

    const clearPendingClose = () => {
        if (closeTimer !== null) {
            window.clearTimeout(closeTimer);
            closeTimer = null;
        }
    };

    const openDrawer = () => {
        clearPendingClose();
        container.classList.remove('hidden');
        setContainerState(true);
        lockBodyScroll();

        window.requestAnimationFrame(() => {
            overlay.classList.remove('opacity-0');
            panel.classList.remove('-translate-x-full');
        });

        isOpen = true;
    };

    const closeDrawer = () => {
        if (!isOpen) {
            setContainerState(false);
            container.classList.add('hidden');
            unlockBodyScroll();
            return;
        }

        overlay.classList.add('opacity-0');
        panel.classList.add('-translate-x-full');
        setContainerState(false);
        unlockBodyScroll();
        isOpen = false;

        clearPendingClose();
        closeTimer = window.setTimeout(() => {
            if (!isOpen) {
                container.classList.add('hidden');
            }
        }, transitionDurationMs);
    };

    openButton.addEventListener('click', openDrawer);
    closeButton.addEventListener('click', closeDrawer);
    overlay.addEventListener('click', closeDrawer);

    panel.addEventListener('click', (event) => {
        const link = event.target.closest('a[href]');

        if (!link) {
            return;
        }

        const href = link.getAttribute('href') ?? '';

        if (href && href !== '#' && !href.startsWith('#')) {
            closeDrawer();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && isOpen) {
            closeDrawer();
        }
    });

    const accordionButtons = container.querySelectorAll('[data-mobile-accordion-button]');

    accordionButtons.forEach((button) => {
        if (button.dataset.mobileAccordionBound === '1') {
            return;
        }

        button.dataset.mobileAccordionBound = '1';

        const targetId = button.getAttribute('data-target');
        if (!targetId) {
            return;
        }

        const panelEl = document.getElementById(targetId);
        if (!panelEl) {
            return;
        }

        const icon = button.querySelector('[data-mobile-accordion-icon]');
        const setExpanded = (expanded) => {
            button.setAttribute('aria-expanded', expanded ? 'true' : 'false');
            panelEl.classList.toggle('hidden', !expanded);
            if (icon) {
                icon.classList.toggle('rotate-180', expanded);
            }
        };

        setExpanded(false);

        button.addEventListener('click', () => {
            const isExpanded = button.getAttribute('aria-expanded') === 'true';
            setExpanded(!isExpanded);
        });
    });
}

if (document.readyState === 'loading') {
    document.addEventListener(
        'DOMContentLoaded',
        () => {
            initializeThemeControl();
            initializeMobileDrawer();
        },
        { once: true }
    );
} else {
    initializeThemeControl();
    initializeMobileDrawer();
}
