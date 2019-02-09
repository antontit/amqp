<?php

declare(strict_types=1);

use Slim\Container;

$config = require 'config/config.php';

return new Container($config);
