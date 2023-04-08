<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Container;


use DI\Container;
use DI\ContainerBuilder;
use Exception;

class ContainerFactory
{
    /**
     * @return Container
     * @throws Exception
     */
    public static function create(): Container
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(Definitions::getDefinitions());

        return $containerBuilder->build();
    }
}
