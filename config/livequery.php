<?php

return [

    'api' => env('LIVEQUERY_API'),

    'endpoints' => [
        'generate_embeddings' => env('LIVEQUERY_ENDPOINT_GENERATE_EMBEDDINGS', '/embed/ca'),
        'chat' => env('LIVEQUERY_ENDPOINT_CHAT', '/qa/query'),
        'suggest_questions' => env('LIVEQUERY_ENDPOINT_SUGGEST_QUESTIONS', '/qa/predict-questions'),
    ]
];
