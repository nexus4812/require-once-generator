<?php declare(strict_types=1);


namespace RequireOnceGenerator\Domain\Model\ValueObject;


interface ValueObjectInterface
{
    public function value(): string|int;
}
