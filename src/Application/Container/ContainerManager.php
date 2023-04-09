<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Container;


use DI\Container;
use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Exception;

class ContainerManager
{
    /**
     * @return Container
     * @throws Exception
     */
    private static function create(): Container
    {
        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions(Definitions::getDefinitions());

        return $containerBuilder->build();
    }

    /**
     * Resolve class dependencies
     *
     * @template T
     * @param class-string<T> $classString
     * @return T
     * @throws DependencyException
     * @throws NotFoundException
     */
    public static function resolve(string $classString): mixed
    {
        return self::create()->make($classString);
    }
}
