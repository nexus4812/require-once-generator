<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Domain\Model\Validation;

trait AssertArrayInstanceOf
{
    use AssertInstanceOf;

    /**
     * @template T of object
     * @param class-string<T> $className
     * @param T[] $objects
     */
    private function assertArrayInstanceOf(string $className, array $objects): void
    {
        foreach ($objects as $object) {
            $this->assertInstanceOf($className, $object);
        }
    }
}
