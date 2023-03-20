<?php declare(strict_types=1);


namespace RequireOnceGenerator\Dependency;


use PhpParser\Node\Stmt;

class DependenciesFactory
{
    /**
     * Dependencies constructor.
     * @param array<int, Stmt> $nodeNames
     */
    public function __construct(private array $nodeNames)
    {
    }
}
