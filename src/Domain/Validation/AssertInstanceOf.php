<?php declare(strict_types=1);


namespace RequireOnceGenerator\Domain\Validation;


use InvalidArgumentException;

trait AssertInstanceOf
{
    /**
     * @param class-string $className
     * @param object $object
     */
    private function assertInstanceOf(string $className, object $object): void
    {
        if ($object instanceof $className) {
            return;
        }
        throw new InvalidArgumentException(__CLASS__. " didn't receive $className");
    }
}
