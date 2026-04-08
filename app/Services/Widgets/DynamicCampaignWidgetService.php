<?php

declare(strict_types=1);

namespace App\Services\Widgets;

use App\Services\Campaigns\CampaignResolver;
use Illuminate\Support\Facades\Route;

final class DynamicCampaignWidgetService
{
    private const DEFAULT_MODE = 'world_cup';

    /**
     * @var array<string, array{
     *     title:string,
     *     subtitle:string,
     *     description:string,
     *     cta_label:string,
     *     cta_route:string
     * }>
     */
    private const MODES = [
        'none' => [
            'title' => '',
            'subtitle' => '',
            'description' => '',
            'cta_label' => '',
            'cta_route' => '',
        ],
        'world_cup' => [
            'title' => 'Dünya Kupası',
            'subtitle' => 'Özel Kampanya',
            'description' => 'Dünya Kupası yolculuğu için hazırladığımız özel içerik sayfasına göz atın.',
            'cta_label' => 'Dünya Kupası Sayfası',
            'cta_route' => 'worldcup.index',
        ],
    ];

    /**
     * @return array{
     *     title:string,
     *     status:string,
     *     props:array<string,mixed>,
     *     data:array<string,mixed>,
     *     meta:array<string,mixed>
     * }
     */
    public function build(): array
    {
        $dbCampaign = app(CampaignResolver::class)->resolve();

        if ($dbCampaign) {
            $resolved = $this->buildFromDb($dbCampaign);

            if ($resolved !== null) {
                return $resolved;
            }
        }

        return $this->buildFromConfig();
    }

    /**
     * @param array<string, mixed> $campaign
     * @return array<string, mixed>|null
     */
    private function buildFromDb(array $campaign): ?array
    {
        $routeName = (string) ($campaign['cta_route_name'] ?? '');

        if ($routeName === '' || ! Route::has($routeName)) {
            return null;
        }

        $params = $campaign['cta_route_params'] ?? [];
        $params = is_array($params) ? $params : [];

        return [
            'title' => (string) ($campaign['title'] ?? ''),
            'status' => 'ok',
            'props' => [],
            'data' => [
                'subtitle' => (string) ($campaign['subtitle'] ?? ''),
                'title' => (string) ($campaign['title'] ?? ''),
                'description' => (string) ($campaign['description'] ?? ''),
                'cta_label' => (string) ($campaign['cta_label'] ?? ''),
                'cta_url' => route($routeName, $params),
            ],
            'meta' => [
                'mode' => (string) ($campaign['key'] ?? 'db'),
                'source' => 'db',
            ],
        ];
    }

    /**
     * @return array{
     *     title:string,
     *     status:string,
     *     props:array<string,mixed>,
     *     data:array<string,mixed>,
     *     meta:array<string,mixed>
     * }
     */
    private function buildFromConfig(): array
    {
        $requestedMode = (string) config('campaigns.active', self::DEFAULT_MODE);
        $mode = array_key_exists($requestedMode, self::MODES) ? $requestedMode : self::DEFAULT_MODE;

        if ($mode === 'none') {
            return [
                'title' => '',
                'status' => 'inactive',
                'props' => [],
                'data' => [],
                'meta' => [
                    'mode' => $mode,
                    'source' => 'static_registry',
                    'reason' => 'no_active_campaign',
                ],
            ];
        }

        $payload = self::MODES[$mode];
        $routeName = $payload['cta_route'];

        if ($routeName === '' || ! Route::has($routeName)) {
            return [
                'title' => '',
                'status' => 'inactive',
                'props' => [],
                'data' => [],
                'meta' => [
                    'mode' => $mode,
                    'source' => 'static_registry',
                    'reason' => 'missing_route',
                ],
            ];
        }

        return [
            'title' => $payload['title'],
            'status' => 'ok',
            'props' => [],
            'data' => [
                'subtitle' => $payload['subtitle'],
                'title' => $payload['title'],
                'description' => $payload['description'],
                'cta_label' => $payload['cta_label'],
                'cta_url' => route($routeName),
            ],
            'meta' => [
                'mode' => $mode,
                'source' => 'static_registry',
            ],
        ];
    }
}
