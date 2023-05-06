<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Domain\Model\ValueObject;

enum LoadMethod
{
    /** @var string */
    case REQUIRE_ONCE;

    /**
     * @var string
     */
    case INCLUDE_ONCE;

    public function toPHPMethodName(): string
    {
        return match ($this) {
            self::REQUIRE_ONCE => 'require_once',
            self::INCLUDE_ONCE => 'include_once',
        };
    }

    public function createPHPCode(string $argument): string
    {
        return $this->toPHPMethodName() . " '". $argument. "';";
    }
}
