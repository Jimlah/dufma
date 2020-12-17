<?php

use App\Middlewares\AccessMiddleware;
use App\Middlewares\AdminMiddleware;
use App\Middlewares\Authentication;
use App\Middlewares\CheckAuthMiddleware;
use App\Middlewares\CheckuserMiddleware;
use App\Middlewares\CsrfMiddleware;
use App\Middlewares\EmployeeMiddleware;
use App\Middlewares\InvestorMiddleware;
use App\Middlewares\OrganizationMiddleware;

return array(
    'auth' => Authentication::class,
    'csrf' => CsrfMiddleware::class,
    'checkAuth' => CheckAuthMiddleware::class,
    'access.admin' => AdminMiddleware::class,
    'access.org' => OrganizationMiddleware::class,
    'access.emp' => EmployeeMiddleware::class,
    'access.inv' => InvestorMiddleware::class,
    'check.user' => CheckuserMiddleware::class,
);