<?php

return [
    /*
    |--------------------------------------------------------------------------
    | World Cup Tournament Rules
    |--------------------------------------------------------------------------
    |
    | Configuration for different World Cup formats.
    |
    */

    '2026' => [
        'best_third_slots' => 8,
        'ranking_sort_fields' => [
            'points' => 'desc',
            'goal_difference' => 'desc',
            'goals_for' => 'desc',
            'won' => 'desc',
        ],
        'players_per_group' => 4,
        'groups_count' => 12,
    ],

    // Fallback or other years if needed
    'default' => [
        'best_third_slots' => 0,
        'ranking_sort_fields' => [
            'points' => 'desc',
            'goal_difference' => 'desc',
            'goals_for' => 'desc',
        ],
    ],

    'ranking_enabled_years' => [2026],
];
