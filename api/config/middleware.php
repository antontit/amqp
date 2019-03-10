<?php

declare(strict_types=1);

return [
    Api\Http\Middleware\CORSMiddleware::class,
    Api\Http\Middleware\DomainExceptionMiddleware::class,
];