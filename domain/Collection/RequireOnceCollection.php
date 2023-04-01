<?php declare(strict_types=1);


namespace RequireOnceGeneratorDomain\Collection;

use RequireOnceGeneratorDomain\Entity\RequireOnce;

class RequireOnceCollection extends Collection
{
    /**
     * Create a new collection.
     *
     * @param  array<string, RequireOnce> $items
     * @return void
     */
    public function __construct(protected array $items = [])
    {
        parent::__construct($this->items);
    }
}
