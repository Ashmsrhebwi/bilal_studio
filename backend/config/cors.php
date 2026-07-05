<?php

return [

    /*
     * Paths that CORS headers will be applied to.
     */
    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    'allowed_origins' => [
        'http://localhost:5173',
        'https://bilal-sardini.vercel.app',
    ],

    // Covers all Vercel preview/branch deploy URLs: bilal-sardini-xxx-user.vercel.app
    'allowed_origins_patterns' => [
        '#^https://bilal-sardini.*\.vercel\.app$#',
    ],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // false: we use token-based auth (Sanctum Bearer tokens), not cookies/sessions
    'supports_credentials' => false,

];
