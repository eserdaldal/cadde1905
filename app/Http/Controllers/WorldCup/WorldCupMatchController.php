<?php

namespace App\Http\Controllers\WorldCup;

use App\Http\Controllers\Controller;
use App\Models\WorldCup\WorldCupMatch;
use App\Services\WorldCup\WorldCupMatchService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WorldCupMatchController extends Controller
{
    public function __construct(private readonly WorldCupMatchService $matchService)
    {
    }

    public function index(Request $request): View
    {
        $data = $this->matchService->getIndexData($request);

        return view('worldcup.matches.index', $data);
    }

    public function show(string $match): View|RedirectResponse
    {
        $matchId = $this->resolveMatchId($match);

        $matchModel = WorldCupMatch::query()
            ->with(['homeTeam', 'awayTeam', 'stadium', 'winnerTeam'])
            ->where('id', $matchId)
            ->where('is_visible', true)
            ->first();

        if (! $matchModel) {
            throw new NotFoundHttpException();
        }

        $canonicalSlug = $this->matchService->buildMatchSlug($matchModel);

        if ($match !== $canonicalSlug) {
            return redirect()->route('worldcup.matches.show', $canonicalSlug, 301);
        }

        $data = $this->matchService->getShowData($matchModel);

        return view('worldcup.matches.show', $data);
    }

    private function resolveMatchId(string $match): int
    {
        if (ctype_digit($match)) {
            return (int) $match;
        }

        if (preg_match('/(\\d+)$/', $match, $matches)) {
            return (int) $matches[1];
        }

        throw new NotFoundHttpException();
    }
}
