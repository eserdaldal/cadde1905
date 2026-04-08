import os

target_path = "resources/css/app.css"

psl_content = """/* 
   CADDE1905 RECONSTRUCTED CSS (PSL v2-ForceInclusion)
   CLEAN BYTES - NO PURGE
*/

@import "tailwindcss";

@source "../views/**/*.blade.php";
@source "../../app/**/*.php";

/* FORCED STRUCTURAL DEFAULTS (No @layer to avoid purge) */

/* Critical Internal Grids */
.grid-2 { display: grid !important; grid-template-columns: repeat(2, minmax(0, 1fr)) !important; gap: 24px !important; }
.grid-3 { display: grid !important; grid-template-columns: repeat(3, minmax(0, 1fr)) !important; gap: 24px !important; }
.grid-4 { display: grid !important; grid-template-columns: repeat(4, minmax(0, 1fr)) !important; gap: 24px !important; }

/* MIRAS SPECIFIC GRID */
.m-grid { 
    display: grid !important; 
    grid-template-columns: repeat(2, minmax(0, 1fr)) !important; 
    gap: 24px !important; 
    margin-bottom: 40px !important; 
}

@media (max-width: 1024px) {
    .grid-3, .m-grid { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
}
@media (max-width: 768px) {
    .grid-2, .grid-3, .grid-4, .m-grid { display: block !important; }
    .grid-2 > *, .grid-3 > *, .grid-4 > *, .m-grid > * { margin-bottom: 24px !important; width: 100% !important; }
}

/* Theme-Aware Shell Components */
.psl-header {
    background-color: var(--card) !important;
    border-bottom: 1px solid var(--border) !important;
    position: sticky !important;
    top: 0 !important;
    z-index: 100 !important;
    transition: background 0.3s ease;
    backdrop-filter: blur(8px);
}
.psl-footer {
    background-color: var(--bg) !important;
    border-top: 1px solid var(--border) !important;
    padding: 40px 0 !important;
}

/* ======================================
   CADDE1905 CUSTOM THEME VARIABLES
====================================== */
:root {
    --red: #A91D35;
    --red-h: #C0263F;
    --yellow: #FCB816;
    --bg: #141414;
    --bg-rgb: 20, 20, 20;
    --card: #1E1E1E;
    --card2: #272727;
    --border: #333333;
    --text: #EBEBEB;
    --text-rgb: 235, 235, 235;
    --muted: #909090;
    --white: #FFFFFF;
}

[data-theme="light"] {
    --bg: #F2F2F2;
    --bg-rgb: 242, 242, 242;
    --card: #FFFFFF;
    --card2: #EBEBEB;
    --border: #D0D0D0;
    --text: #141414;
    --text-rgb: 20, 20, 20;
    --muted: #606060;
}

/* ======================================
   MIRAS PAGE RECOVERY (FORCE)
====================================== */
.miras-hero { 
    background: linear-gradient(135deg, #09090b 0%, #1a1a1a 100%) !important; 
    padding: 80px 40px !important; 
    border-radius: 24px !important; 
    margin-bottom: 48px !important; 
    border: 1px solid var(--border) !important;
    text-align: center;
}
.miras-hero-title { font-size: 48px !important; font-weight: 900 !important; color: #fff !important; margin-bottom: 16px !important; }

.miras-section { margin-bottom: 60px !important; display: block !important; }
.miras-sec-title { font-size: 24px !important; font-weight: 800 !important; color: var(--text) !important; margin-bottom: 24px !important; display: flex !important; align-items: center; gap: 12px; }
.miras-sec-title::before { content: ''; width: 4px; height: 24px; background: var(--yellow); border-radius: 2px; }

.card-legend, .card-trophy, .card-season { 
    background: var(--card) !important; 
    border: 1px solid var(--border) !important; 
    border-radius: 20px !important; 
    padding: 32px !important; 
    display: block !important; 
    text-decoration: none !important; 
    color: var(--text) !important;
    border-left: 4px solid var(--red);
}

/* HOMEPAGE HERO FIX */
.hero-section { position: relative !important; min-height: 400px !important; overflow: hidden !important; border-radius: 16px !important; }
.hero-overlay { position: absolute !important; bottom: 0 !important; left: 0 !important; padding: 40px !important; width: 100% !important; z-index: 10; }

body { font-family: 'Manrope', sans-serif; background: var(--bg); color: var(--text); }
"""

with open(target_path, "w", encoding="utf-8") as f:
    f.write(psl_content)

print(f"SUCCESS: Final Force-Overwrite of app.css.")
