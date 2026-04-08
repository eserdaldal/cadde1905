<?php

use App\Models\WorldCup\WorldCup;
use App\Models\WorldCup\Stadium;

$out = "--- TOURNAMENTS ---\n";
foreach(WorldCup::withoutGlobalScopes()->get() as $wc) {
    $out .= "ID: {$wc->id} | Name: {$wc->name} | Year: {$wc->year} | ExtID: {$wc->external_id} | Active: " . ($wc->is_active ? 'Y' : 'N') . " | Visible: " . ($wc->is_visible ? 'Y' : 'N') . "\n";
}

$out .= "\n--- STADIUMS (TID=4) ---\n";
foreach(Stadium::where('tournament_id', 4)->get() as $std) {
    $out .= "ID: {$std->id} | Name: {$std->name_api} | City: {$std->city_api} | ExtID: {$std->external_id}\n";
}

$out .= "\n--- STADIUMS (TID=3) ---\n";
foreach(Stadium::where('tournament_id', 3)->get() as $std) {
    $out .= "ID: {$std->id} | Name: {$std->name_api} | City: {$std->city_api} | ExtID: {$std->external_id}\n";
}

file_put_contents('C:\laragon\www\cadde1905\wc_inspect.log', $out);
echo "DONE\n";
