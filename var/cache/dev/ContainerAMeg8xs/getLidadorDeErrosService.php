<?php

namespace ContainerAMeg8xs;

use Symfony\Component\DependencyInjection\Argument\RewindableGenerator;
use Symfony\Component\DependencyInjection\Exception\RuntimeException;

/**
 * @internal This class has been auto-generated by the Symfony Dependency Injection Component.
 */
class getLidadorDeErrosService extends App_KernelDevDebugContainer
{
    /**
     * Gets the private 'App\Helper\LidadorDeErros' shared autowired service.
     *
     * @return \App\Helper\LidadorDeErros
     */
    public static function do($container, $lazyLoad = true)
    {
        include_once \dirname(__DIR__, 4).'/src/Helper/LidadorDeErros.php';

        return $container->privates['App\\Helper\\LidadorDeErros'] = new \App\Helper\LidadorDeErros(($container->privates['monolog.logger'] ?? $container->load('getMonolog_LoggerService')));
    }
}
