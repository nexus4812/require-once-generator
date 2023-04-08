<?php declare(strict_types=1);


namespace RequireOnceGenerator\Domain\Model\Collection;


use RequireOnceGenerator\Domain\Model\Validation\AssertArrayInstanceOf;

/**
 * @template TKey of array-key
 * @template TValue of object
 * @extends Collection<TKey, TValue>
 */
abstract class ObjectCollection extends Collection
{
    use AssertArrayInstanceOf;

    /** @var class-string<TValue>  */
    protected string $className;

    /**
     * Create a new collection.
     *
     * @param  array<TKey, TValue> $items
     * @return void
     */
    public function __construct(array $items = [])
    {
        $this->assertArrayInstanceOf($this->className, $items);
        parent::__construct($items);
    }

    /**
     * @param TValue $item
     */
    public function add(mixed $item): void
    {
        $this->assertInstanceOf($this->className, $item);
        $this->items[] = $item;
    }
}
