<nav class="wc-top-nav">
  <div class="wc-top-nav__inner">

    <a href="{{ route('worldcup.index') }}"
       class="wc-nav-item {{ request()->routeIs('worldcup.index') ? 'is-active' : '' }}">
       Genel Bakış
    </a>

    <a href="{{ route('worldcup.teams.index') }}"
       class="wc-nav-item {{ request()->routeIs('worldcup.teams.*') ? 'is-active' : '' }}">
       Takımlar
    </a>

    <a href="{{ route('worldcup.matches.index') }}"
       class="wc-nav-item {{ request()->routeIs('worldcup.matches.*') ? 'is-active' : '' }}">
       Maçlar
    </a>

    <a href="{{ route('worldcup.groups.index') }}"
       class="wc-nav-item {{ request()->routeIs('worldcup.groups.*') ? 'is-active' : '' }}">
       Gruplar
    </a>

    <a href="{{ route('worldcup.stats.index') }}"
       class="wc-nav-item {{ request()->routeIs('worldcup.stats.*') ? 'is-active' : '' }}">
       İstatistikler
    </a>

    <a href="{{ route('worldcup.stadiums.index') }}"
       class="wc-nav-item {{ request()->routeIs('worldcup.stadiums.*') ? 'is-active' : '' }}">
       Stadyumlar
    </a>

    <a href="{{ route('worldcup.aslanlar.index') }}"
       class="wc-nav-item {{ request()->routeIs('worldcup.aslanlar.*') ? 'is-active' : '' }}">
       Kupadaki Aslanlar
    </a>

  </div>
</nav>
