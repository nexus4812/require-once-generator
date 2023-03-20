<?php declare(strict_types=1);


namespace RequireOnceGenerator\Parser;

use PhpParser\Node;
use PhpParser\NodeFinder;

class NodeFilter
{
    public function __construct(private NodeFinder $nodeFinder)
    {
    }

    public static function factory(): self
    {
        return new self(new NodeFinder());
    }

    /**
     * @param Node[] $stmts
     * @return Node\Name[]
     */
    public function filterName(array $stmts): array
    {
        return $this->nodeFinder->findInstanceOf($stmts,Node\Name::class);
    }

    /**
     * @param Node[] $stmts
     * @return Node\Stmt\Namespace_[]
     */
    public function filterNameSpace(array $stmts): array
    {
        return $this->nodeFinder->findInstanceOf($stmts,Node\Stmt\Namespace_::class);
    }

    /**
     * @param Node[] $stmts
     * @return Node\Stmt\ClassLike[]
     */
    public function filterClassLike(array $stmts): array
    {
        return $this->nodeFinder->findInstanceOf($stmts,Node\Stmt\ClassLike::class);
    }
}
