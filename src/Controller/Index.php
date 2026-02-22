<?php

declare(strict_types=1);

namespace App\Controller;

use App\Http\Response\HtmlResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

final readonly class Index implements RequestHandlerInterface
{
    public function __construct(
        private Environment $twig
    ) {}

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $response = new HtmlResponse(
            $this->twig->render('index.html.twig', [
                'title' => 'Home page',
                'header' => 'Home',
                'content' => 'Hello World!'
            ])
        );

        return $response;
    }
}
