foreach(Database\Schema\Blueprint::class ? DB::table("world_cup_stadiums")->where("tournament_id", 4)->get() : [] as $s) {
    echo $s->name_api . ":" . $s->id . "\n";
}
