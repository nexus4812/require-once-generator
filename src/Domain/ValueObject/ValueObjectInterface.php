<?php declare(strict_types=1);


namespace RequireOnceGeneratorDomain\ValueObject;


interface ValueObjectInterface
{
    public function value(): string|int;
}
