<?php declare(strict_types=1);


namespace RequireOnceGeneratorDomain\ValueObject;


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
    private function __construct(private string $method_name)
    {
    }

    public static function require_once(): self
    {
        return new self(self::REQUIRE_ONCE);
    }

    public static function include_once(): self
    {
        return new self(self::INCLUDE_ONCE);
    }

    public function value(): string
    {
        return $this->method_name;
    }

    public function createPHPCode(string $argument): string
    {
        return $this->value(). '"'. $argument. '";';
    }
}
