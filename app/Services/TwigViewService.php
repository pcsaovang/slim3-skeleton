<?php namespace App\Services;

use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use App\Kernel\ServiceInterface;

class TwigViewService implements ServiceInterface
{

    /**
     * Service register name
     */
    public function name()
    {
        return 'view';
    }

    /**
     * Register new service on dependency container
     */
    public function register()
    {
        return function ($container) {
            $view = new Twig(
                app_path() . '/Views',
                $container->get('settings')['twig']
            );

            $view->addExtension(
                new TwigExtension(
                    $container['router'],
                    $container['request']->getUri()
                )
            );

            unset($container);

            return $view;
        };
    }
}
