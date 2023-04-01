<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Parser;

use PhpParser\Node;

class NodeCollection
{
    /**
     * NodeCollection constructor.
     * @param array<Node\Stmt> $nodes
     * @param NodeFilter $filter
     */
    public function __construct(
        private NodeFilter $filter,
        private array $nodes
    )
    {
    }

    public function findNameSpace(): Node\Stmt\Namespace_|null
    {
        return $this->filter->findNameSpace($this->nodes);
    }

    /**
     * @return Node\Name[]
     */
    public function filterName(): array
    {
        return $this->filter->filterName($this->nodes);
    }
}
