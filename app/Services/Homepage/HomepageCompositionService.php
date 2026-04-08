<?php

namespace App\Services\Homepage;

use App\Services\Homepage\Resolvers\LatestNewsBlockResolver;

final class HomepageCompositionService
{
    public function __construct(
        private readonly HeroResolver $heroResolver,
        private readonly LatestNewsBlockResolver $latestNewsBlockResolver,
        private readonly VideoBlockResolver $videoResolver,
        private readonly HistoryBlockResolver $historyResolver,
    ) {
    }

    public function compose(int $latestNewsLimit = 6): HomepageViewData
    {
        $bag = new ExclusionBag();

        $hero = $this->heroResolver->resolve();

        if ($hero !== null) {
            $bag->add($hero->contentKey);
        }

        $latestNews = $this->latestNewsBlockResolver->resolve($bag, $latestNewsLimit);

        $bag->addMany(array_map(
            static fn (NormalizedContentItem $item): string => $item->contentKey,
            $latestNews
        ));

        $video = []; // $this->videoResolver->resolve($bag, 3);

        /*
        $bag->addMany(array_map(
            static fn (NormalizedContentItem $item): string => $item->contentKey,
            $video
        ));
        */

        $archive = [];
        $gallery = [];

        $history = $this->historyResolver->resolve($bag, 4);

        $bag->addMany(array_map(
            static fn (NormalizedContentItem $item): string => $item->contentKey,
            $history
        ));

        return new HomepageViewData(
            hero: $hero,
            latestNews: $latestNews,
            exclusionKeys: $bag->all(),
            archive: $archive,
            video: $video,
            gallery: $gallery,
            history: $history,
        );
    }
}
