<?php

use App\Middlewares\Authentication;
use App\Middlewares\CheckAuthMiddleware;
use App\Middlewares\CsrfMiddleware;

return array(
    'auth' => Authentication::class,
    'csrf' => CsrfMiddleware::class,
    'checkAuth' => CheckAuthMiddleware::class,
);