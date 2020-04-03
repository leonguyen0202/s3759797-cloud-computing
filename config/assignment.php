<?php

return [
    'project_id' => env('GOOGLE_BIG_QUERY_PROJECT_ID'),

    /*
     * If you want another dataset of big query
     * Replicate this array
     * 
     * REMEMBER: Change name of replicate
     */
    'big_query' => [
        'data_set' => env('GOOGLE_BIG_QUERY_DATASET'),
        'table_name' => env('GOOGLE_BIG_QUERY_TABLE_NAME'),
        'type' => env('GOOGLE_BIG_QUERY_TYPE'),
        'private_key_id' => env('GOOGLE_BIG_QUERY_PRIVATE_KEY_ID'),
        'private_key' => env('GOOGLE_BIG_QUERY_PRIVATE_KEY'),
        'client_email' => env('GOOGLE_BIG_QUERY_CLIENT_EMAIL'),
        'client_id' => env('GOOGLE_BIG_QUERY_CLIENT_ID'),
        'auth_uri' => env('GOOGLE_BIG_QUERY_AUTH_URI'),
        'token_uri' => env('GOOGLE_BIG_QUERY_TOKEN_URI'),
        'auth_provider_x509_cert_url' => env('GOOGLE_BIG_QUERY_AUTH_PROVIDER_CERT_URL'),
        'client_x509_cert_url' => env('GOOGLE_BIG_QUERY_CLIENT_x509_CERT_URL'),
    ],
];