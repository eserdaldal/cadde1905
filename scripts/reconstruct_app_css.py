import os

stable_base_path = "resources/css/app.v3-stable.css"
target_path = "resources/css/app.css"

with open(stable_base_path, "r", encoding="utf-8") as f:
    stable_content = f.read()

# Normalize: Ensure we don't have overlapping tailwind imports if the base already had them
if '@import "tailwindcss";' not in stable_content:
    psl_header = '@import "tailwindcss";\n\n'
else:
    psl_header = ""

psl_header += """
@source "../views/**/*.blade.php";
@source "../../app/**/*.php";

@layer components {
    /* Critical Internal Grids */
    .grid-2 { display: grid !important; grid-template-columns: repeat(2, minmax(0, 1fr)) !important; gap: 24px !important; }
    .grid-3 { display: grid !important; grid-template-columns: repeat(3, minmax(0, 1fr)) !important; gap: 24px !important; }
    .grid-4 { display: grid !important; grid-template-columns: repeat(4, minmax(0, 1fr)) !important; gap: 24px !important; }

    @media (max-width: 1024px) {
        .grid-3 { grid-template-columns: repeat(2, minmax(0, 1fr)) !important; }
    }
    @media (max-width: 768px) {
        .grid-2, .grid-3, .grid-4 { display: block !important; }
        .grid-2 > *, .grid-3 > *, .grid-4 > * { margin-bottom: 24px; width: 100% !important; }
    }

    /* Theme-Aware Shell Components (Force Fixed Transparency) */
    .psl-header {
        background-color: var(--card) !important;
        border-bottom: 1px solid var(--border) !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 100 !important;
        transition: background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(8px);
    }
    .psl-footer {
        background-color: var(--bg) !important;
        border-top: 1px solid var(--border) !important;
        padding-top: 40px;
        padding-bottom: 40px;
    }
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
   HOMEPAGE & MIRAS RECONSTRUCTION (PSL)
====================================== */
.hero-section { position: relative; border-radius: 16px; overflow: hidden; aspect-ratio: 16/9; margin-bottom: 32px; border: 1px solid var(--border); }
.hero-section img { width: 100%; height: 100%; object-fit: cover; }
.hero-gradient { position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, transparent 60%); }
.hero-overlay { position: absolute; bottom: 0; left: 0; padding: 40px; width: 100%; }
.hero-badge { background: var(--red); color: #fff; padding: 4px 12px; border-radius: 4px; font-size: 12px; font-weight: 800; display: inline-block; margin-bottom: 12px; }

.gundem-card { background: var(--card); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; position: relative; transition: transform 0.3s ease; }
.gundem-card:hover { transform: translateY(-5px); border-color: var(--red); }
.gundem-card .img-wrap { aspect-ratio: 16/10; overflow: hidden; }
.gundem-card img { width: 100%; height: 100%; object-fit: cover; }

.miras-hero { background: linear-gradient(135deg, #09090b 0%, #1a1a1a 100%); padding: 80px 40px; border-radius: 24px; margin-bottom: 48px; position: relative; overflow: hidden; border: 1px solid var(--border); }
.miras-hero::after { content: ''; position: absolute; inset: 0; background: radial-gradient(circle at center, rgba(169,29,53,0.1) 0%, transparent 70%); }
.miras-hero-title { font-size: 48px; font-weight: 900; color: #fff; position: relative; z-index: 2; margin-bottom: 16px; letter-spacing: -1px; }

.m-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 40px; }
.miras-sec-title { font-size: 24px; font-weight: 800; color: var(--text); display: flex; align-items: center; gap: 12px; }
.miras-sec-title::before { content: ''; width: 4px; height: 24px; background: var(--yellow); border-radius: 2px; }

.card-legend, .card-trophy, .card-season { background: var(--card); border: 1px solid var(--border); border-radius: 20px; padding: 32px; text-decoration: none; transition: all 0.3s; display: block; border-left: 4px solid var(--red); }
.card-legend:hover, .card-trophy:hover { border-color: var(--yellow); transform: translateX(8px); }

/* Ensure Sidebar remains functional */
.sidebar-area { display: flex; flex-direction: column; gap: 24px; }
"""

final_content = psl_header + stable_content

# Atomic write to avoid corruption
temp_path = "resources/css/app_rebuilt_atomic.css"
with open(temp_path, "w", encoding="utf-8") as f:
    f.write(final_content)

print(f"SUCCESS: Rebuilt CSS saved to {temp_path}")
print(f"Base size: {len(stable_content)} bytes")
print(f"Final size: {len(final_content)} bytes")
