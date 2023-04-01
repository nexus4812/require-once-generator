<?php declare(strict_types=1);


namespace RequireOnceGenerator\Domain\ValueObject;


interface ValueObjectInterface
{
    public function value(): string|int;
}
