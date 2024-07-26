<?php

namespace App\Services;

use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Http;

readonly class LiveQueryService
{
    private string $api;
    private array $endpoints;
    public function __construct() {
        $this->api = config('livequery.api');
        $this->endpoints = config('livequery.endpoints');
    }

    public function createEmbeddings(array $articles) {
        try {
            $response = Http::post($this->api . $this->endpoints['generate_embeddings'], $articles);
            return $response->json();
        } catch (\Exception $exception) {
            logger($exception);
        }
    }

    public function liveQuery(string $query, array $params = []) {

    }

    public function suggestQuestions(int $chatId, ?int $articleId) {

    }
}
