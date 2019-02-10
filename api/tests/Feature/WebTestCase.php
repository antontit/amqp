<?php

declare(strict_types=1);

namespace Test\Feature;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\Response;
use Slim\Http\Uri;
use Slim\App;

class WebTestCase extends TestCase
{
    protected function get(string $url)
    {
        return $this->method($url, 'GET');
    }

    protected function method(string $uri, $method): ResponseInterface
    {
        return $this->response(
            (new ServerRequest())
                ->withUri(new Uri('http', 'test' . $uri))
                ->withMethod($method)
        );
    }

    protected function response(ServerRequestInterface $request): ResponseInterface
    {
        $response = $this->app()->process($request, new Response());
        $response->getBody()->rewind();
        return $response;
    }

    protected function app(): App
    {
        $container = $this->container();
        $app = new App($container);
        (require 'config/routes.php')($app);
        return $app;
    }

    protected function container(): ContainerInterface
    {
        return require 'config/container.php';
    }
}