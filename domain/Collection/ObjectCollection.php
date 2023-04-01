<?php declare(strict_types=1);


namespace RequireOnceGeneratorDomain\Collection;


use RequireOnceGeneratorDomain\Validation\AssertArrayInstanceOf;

/**
 * @template TKey of array-key
 * @template TValue of object
 */
class ObjectCollection extends Collection // @phpstan-ignore-line
{
    use AssertArrayInstanceOf;

    /** @var class-string<TValue>  */
    protected const CLASS_NAME = ''; /** @phpstan-ignore-line */

    /**
     * Create a new collection.
     *
     * @param  array<TKey, TValue> $items
     * @return void
     */
    public function __construct(array $items = [])
    {
        $this->assertArrayInstanceOf(self::CLASS_NAME, $items); // @phpstan-ignore-line
        parent::__construct($items);
    }

    /**
     * @param TValue $item
     */
    public function add(mixed $item): void
    {
        $this->assertInstanceOf(self::CLASS_NAME, $item); // @phpstan-ignore-line
        $this->items[] = $item;
    }
}
