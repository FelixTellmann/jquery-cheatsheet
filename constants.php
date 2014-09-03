<?php

return [
    'ENVIRONMENT' => 'development',
    'BASE_URL' => 'http://localhost',
    'PUBLIC_ROOT' => __DIR__.'/public',
    'SECURE_KEY' => md5(uniqid(rand(), true))
];
