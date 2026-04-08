@php
    $rounds = $knockoutData['rounds'] ?? [];
@endphp

<div class="wc-bracket-container" id="wc-bracket-scroll-container">
    <div class="wc-bracket">
        @foreach ($rounds as $index => $round)
            <div class="wc-round" 
                 data-round="{{ $round['key'] }}"
                 id="{{ $index === 0 ? 'wc-bracket-start' : '' }}">
                
                <div class="wc-round-header">
                    {{ $round['label'] }}
                </div>

                <div class="flex flex-col justify-around flex-grow gap-8">
                    @foreach ($round['matches'] as $match)
                        <div class="relative wc-match-wrapper" 
                             data-teams='["{{ $match->homeTeam->name }}", "{{ $match->awayTeam->name }}", "{{ $match->homeTeam->original_name ?? '' }}", "{{ $match->awayTeam->original_name ?? '' }}"]'>
                            
                            @include('worldcup.partials.knockout-match-card', [
                                'match' => $match,
                                'roundKey' => $round['key']
                            ])
                            
                            {{-- Output Connectors --}}
                            @if(!$loop->parent->last)
                                <div class="wc-connector wc-connector-out" 
                                     data-rel-match="{{ $match->id }}"
                                     data-rel-teams='["{{ $match->homeTeam->name }}", "{{ $match->awayTeam->name }}"]'></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const container = document.getElementById('wc-bracket-scroll-container');
        const startPoint = document.getElementById('wc-bracket-start');
        
        if (container && startPoint && window.innerWidth < 1024) {
            container.scrollLeft = 0;
        }

        const cards = document.querySelectorAll('.wc-match-card');
        const bracket = document.querySelector('.wc-bracket-container');
        const connectors = document.querySelectorAll('.wc-connector');

        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                const wrapper = card.closest('.wc-match-wrapper');
                const teams = JSON.parse(wrapper.dataset.teams || '[]');
                
                bracket.classList.add('is-hovering');
                card.classList.add('is-hovering');
                
                // Highlight related connectors
                connectors.forEach(conn => {
                    const relTeams = JSON.parse(conn.dataset.relTeams || '[]');
                    const matchId = conn.dataset.relMatch;
                    
                    if (teams.some(t => t && relTeams.includes(t)) || matchId == card.dataset.matchId) {
                        conn.classList.add('is-active');
                    }
                });
            });

            card.addEventListener('mouseleave', () => {
                bracket.classList.remove('is-hovering');
                card.classList.remove('is-hovering');
                connectors.forEach(conn => conn.classList.remove('is-active'));
            });
        });
    });
</script>
