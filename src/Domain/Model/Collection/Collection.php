<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Domain\Model\Collection;

/**
 * @template TKey of array-key
 * @template TValue
 */
class Collection
{
    /**
     * Create a new collection.
     *
     * @param  array<TKey, TValue> $items
     * @return void
     */
    public function __construct(protected array $items = [])
    {
    }

    /**
     * @param TValue $item
     */
    public function add(mixed $item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return TValue[]
     */
    public function all(): array
    {
        return $this->items;
    }
}
