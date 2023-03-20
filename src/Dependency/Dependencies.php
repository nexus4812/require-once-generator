<?php declare(strict_types=1);


namespace RequireOnceGenerator\Dependency;


use PhpParser\Node\Name;

class Dependencies
{
    /**
     * Dependencies constructor.
     * @param array<int, Name> $nodeNames
     */
    public function __construct(private array $nodeNames)
    {
    }

    public function addClassName(): void
    {

    }
}
