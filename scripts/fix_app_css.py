css_content = """@import "tailwindcss";

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

    /* Theme-Aware Shell Components */
    .psl-header {
        background-color: var(--card) !important;
        border-bottom: 1px solid var(--border) !important;
        position: sticky !important;
        top: 0 !important;
        z-index: 50 !important;
        transition: background 0.25s, border-color 0.25s;
    }
    .psl-footer {
        background-color: var(--bg) !important;
        border-top: 1px solid var(--border) !important;
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
   BASE & LAYOUT
====================================== */
html { scroll-behavior: smooth; }
body { font-family: 'Manrope', sans-serif; background: var(--bg); color: var(--text); font-size: 15px; line-height: 1.6; min-height: 100vh; transition: background .25s, color .25s; }
.page { max-width: 1340px; margin: 0 auto; padding: 24px 24px; }
.main-grid { display: grid; grid-template-columns: minmax(0, 1fr) 360px; gap: 32px; align-items: start; }

/* ======================================
   NEWS GRID & CARDS
====================================== */
.news-grid { display: grid; grid-template-columns: 1.25fr 1fr; gap: 16px; margin-bottom: 32px; }
.news-card { background: var(--card); border: 1px solid var(--border); border-radius: 14px; overflow: hidden; cursor: pointer; transition: all .3s cubic-bezier(0.4, 0, 0.2, 1); text-decoration: none; display: flex; flex-direction: row; height: 120px; }
.news-card:hover { border-color: var(--red); transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
.news-grid .news-card:nth-child(1) { grid-row: span 3; display: flex; flex-direction: column; height: 100%; }
.news-grid .news-card:not(:nth-child(1)) .nc-img { width: 130px; height: 100%; flex-shrink: 0; }
.nc-img { aspect-ratio: 16/9; position: relative; overflow: hidden; }
.nc-img img { width: 100%; height: 100%; object-fit: cover; display: block; }
.nc-body { padding: 12px 13px 13px; }
.nc-title { font-size: 13px; font-weight: 700; line-height: 1.4; color: var(--text); margin-bottom: 7px; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }

/* ======================================
   MIRAS BENTO GRID (PSL ENFORCED)
====================================== */
.miras-bento-grid {
    display: grid !important;
    grid-template-columns: repeat(6, 1fr) !important;
    grid-auto-rows: minmax(180px, auto) !important;
    gap: 1.5rem !important;
}
.miras-card {
    position: relative;
    border-radius: 32px;
    overflow: hidden;
    background: #09090b;
    border: 1px solid rgba(255, 255, 255, 0.03);
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    display: flex;
    flex-direction: column;
    justify-content: flex-end;
    padding: 2rem;
    z-index: 1;
    min-height: 200px;
}
.miras-card:hover { transform: translateY(-8px); border-color: rgba(252, 184, 22, 0.4); box-shadow: 0 30px 60px -12px rgba(0, 0, 0, 0.7); }
.miras-card-bg { position: absolute; inset: 0; z-index: -1; background-size: cover; background-position: center; transition: transform 0.8s ease; opacity: 0.35; }
.miras-card:hover .miras-card-bg { transform: scale(1.15); opacity: 0.5; }
.miras-card-overlay { position: absolute; inset: 0; background: linear-gradient(to top, #09090b 10%, rgba(9, 9, 11, 0.6) 50%, transparent 100%); z-index: 0; }
.miras-card-content { position: relative; z-index: 2; }
.span-4 { grid-column: span 4 !important; }
.span-3 { grid-column: span 3 !important; }
.span-2 { grid-column: span 2 !important; }
.row-2 { grid-row: span 2 !important; }

@media (max-width: 1024px) {
    .miras-bento-grid { grid-template-columns: repeat(4, 1fr) !important; }
    .news-grid { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
    .miras-bento-grid { grid-template-columns: repeat(1, 1fr) !important; }
    .span-4, .span-3, .span-2 { grid-column: span 1 !important; }
}

/* ======================================
   SIDEBAR & WIDGETS
====================================== */
.sidebar { display: flex; flex-direction: column; gap: 24px; }
.widget { background: var(--card); border: 1px solid var(--border); border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05); }
.wid-hd { padding: 16px 18px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
.wid-title { font-size: 12.5px; font-weight: 800; color: var(--text); display: flex; align-items: center; gap: 7px; }
.wid-title::before { content: ''; width: 6px; height: 6px; border-radius: 50%; background: var(--red); display: block; }
"""

with open("resources/css/app.css", "w", encoding="utf-8") as f:
    f.write(css_content)
print("SUCCESS: app.css written via Python.")
