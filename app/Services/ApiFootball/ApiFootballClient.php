<?php

declare(strict_types=1);

namespace App\Services\ApiFootball;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use RuntimeException;

final class ApiFootballClient
{
    private string $baseUrl;
    private string $apiKey;
    private int $timeout;

    public function __construct()
    {
        $this->baseUrl = rtrim((string) config('services.api_football_wc.base_url'), '/');
        $this->apiKey = (string) config('services.api_football_wc.key');
        $this->timeout = (int) config('services.api_football_wc.timeout', 10);

        if ($this->apiKey === '' || $this->apiKey === 'BURAYA_GERCEK_API_KEY') {
            throw new RuntimeException('API_FOOTBALL_WC_KEY tanımlı değil veya placeholder durumda.');
        }
    }

    /**
     * @param array<string, scalar|null> $query
     * @return array<string, mixed>
     */
    public function get(string $endpoint, array $query = []): array
    {
        try {
            $response = Http::baseUrl($this->baseUrl)
                ->acceptJson()
                ->timeout($this->timeout)
                ->retry(2, 300)
                ->withHeaders([
                    'x-apisports-key' => $this->apiKey,
                ])
                ->get($endpoint, $query)
                ->throw();

            /** @var array<string, mixed> $data */
            $data = $response->json();

            return $data;
        } catch (ConnectionException $e) {
            throw new RuntimeException('API-Football (WC) bağlantı/DNS/timeout hatası: ' . $e->getMessage(), 0, $e);
        } catch (RequestException $e) {
            $status = $e->response?->status();
            $body = $e->response?->body();

            throw new RuntimeException(
                'API-Football (WC) istek hatası. HTTP: ' . (string) $status . ' | Response: ' . (string) $body,
                0,
                $e
            );
        }
    }
}
