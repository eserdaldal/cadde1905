@extends('layouts.app')

@section('content')
<div class="mx-auto w-full max-w-7xl px-4 sm:px-6 lg:px-8 standings-page sp-wrap">
    <div class="sp-stack">

        {{-- Sayfa Başlığı Kartı --}}
        <section class="sp-hero-card">
            <p class="sp-hero-kicker">
                Süper Lig
            </p>
            <h1 class="sp-hero-title">
                {{ $pageTitle ?? 'Puan Durumu' }}
            </h1>
            <p class="sp-hero-desc">
                Güncel lig tablosu aşağıda gösteriliyor.
            </p>
        </section>

        {{-- Puan Tablosu Kartı --}}
        <section class="sp-table-card">
            {{-- Başlık Şeridi --}}
            <div class="sp-table-head">
                <span class="sp-table-dot"></span>
                <h2 class="sp-table-title">Lig Tablosu</h2>
            </div>

            <div class="sp-table-body">
                @if(!empty($table) && is_array($table))
                    <div class="sp-table-scroll">
                        <table class="sp-table">
                            <thead>
                                <tr class="sp-table-head-row">
                                    <th class="sp-th sp-th-rank">
                                        <span class="sp-th-hidden">Sıra</span>
                                    </th>
                                    <th class="sp-th sp-th-team">Takım</th>
                                    <th class="sp-th sp-th-stat">O</th>
                                    <th class="sp-th sp-th-stat">G</th>
                                    <th class="sp-th sp-th-stat">B</th>
                                    <th class="sp-th sp-th-stat">M</th>
                                    <th class="sp-th sp-th-av">AV</th>
                                    <th class="sp-th sp-th-points">P</th>
                                    <th class="sp-th sp-th-form">Form</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($table as $row)
                                    <tr class="sp-row {{ !empty($row['is_galatasaray']) ? 'sp-row-highlight' : '' }}">
                                        {{-- Sıra --}}
                                        <td class="sp-cell sp-cell-rank">
                                            {{ $row['rank'] ?? '-' }}
                                        </td>

                                        {{-- Takım --}}
                                        <td class="sp-cell sp-cell-team">
                                            <div class="sp-team-row">
                                                @if(!empty($row['team_logo']))
                                                    <div class="sp-team-logo-wrap">
                                                        <img src="{{ $row['team_logo'] }}" alt="{{ $row['team_name'] ?? 'Takım' }}" loading="lazy" class="sp-team-logo">
                                                    </div>
                                                @endif
                                                <span class="sp-team-name">
                                                    {{ $row['team_name'] ?? '-' }}
                                                </span>
                                            </div>
                                        </td>

                                        {{-- Oynanan --}}
                                        <td class="sp-cell sp-cell-stat">
                                            {{ $row['played'] ?? '-' }}
                                        </td>

                                        {{-- Galibiyet --}}
                                        <td class="sp-cell sp-cell-stat">
                                            {{ $row['won'] ?? '-' }}
                                        </td>

                                        {{-- Beraberlik --}}
                                        <td class="sp-cell sp-cell-stat">
                                            {{ $row['drawn'] ?? '-' }}
                                        </td>

                                        {{-- Mağlubiyet --}}
                                        <td class="sp-cell sp-cell-stat">
                                            {{ $row['lost'] ?? '-' }}
                                        </td>

                                        {{-- Averaj --}}
                                        <td class="sp-cell sp-cell-stat sp-cell-av">
                                            {{ $row['goals_diff'] ?? '-' }}
                                        </td>

                                        {{-- Puan --}}
                                        <td class="sp-cell sp-cell-points">
                                            {{ $row['points'] ?? '-' }}
                                        </td>

                                        {{-- Form --}}
                                        <td class="sp-cell sp-cell-form">
                                            <div class="sp-form">
                                                @foreach(str_split((string) ($row['form'] ?? '')) as $formChar)
                                                    @if($formChar === 'W')
                                                        <span
                                                            title="Galibiyet"
                                                            class="sp-form-pill sp-form-win"
                                                        >✓</span>
                                                    @elseif($formChar === 'D')
                                                        <span
                                                            title="Beraberlik"
                                                            class="sp-form-pill sp-form-draw"
                                                        >•</span>
                                                    @elseif($formChar === 'L')
                                                        <span
                                                            title="Mağlubiyet"
                                                            class="sp-form-pill sp-form-loss"
                                                        >✕</span>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="sp-empty">
                        Lig tablosu verisi bulunamadı.
                    </p>
                @endif
            </div>
        </section>

    </div>
</div>
@endsection
