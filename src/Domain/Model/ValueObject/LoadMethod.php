<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Domain\Model\ValueObject;

class LoadMethod implements ValueObjectInterface
{
    /** @var string  */
    private const REQUIRE_ONCE = 'require_once';

    /**
     * @var string
     */
    private const INCLUDE_ONCE = 'include_once';

    /**
     * LoadMethod constructor.
     */
    private function __construct(private string $methodName)
    {
    }

    public static function requireOnce(): self
    {
        return new self(self::REQUIRE_ONCE);
    }

    public static function includeOnce(): self
    {
        return new self(self::INCLUDE_ONCE);
    }

    public function value(): string
    {
        return $this->methodName;
    }

    public function createPHPCode(string $argument): string
    {
        return $this->value(). '"'. $argument. '";';
    }
}
