<?php declare(strict_types=1);


namespace RequireOnceGenerator\Parser;

use PhpParser\Node;
use PhpParser\Node\Stmt;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\NodeFinder;

class NodeFilter extends NodeFinder
{
    /**
     * @param Stmt[] $stmts
     * @return Node\Name[]
     */
    public function filterName(array $stmts): array
    {
        /* @phpstan-ignore-next-line */
        return $this->findInstanceOf($stmts, Node\Name::class);
    }

    /**
     * @param Stmt[] $stmts
     * @return Node\Name\FullyQualified[]
     */
    public function filterFullyQualified(array $stmts): array
    {
        /* @phpstan-ignore-next-line */
        return $this->findInstanceOf($stmts, Node\Name\FullyQualified::class);
    }

    /**
     * @param Stmt[] $stmts
     * @return Namespace_|null
     */
    public function findNameSpace(array $stmts): Namespace_|null
    {
        /* @phpstan-ignore-next-line */
        return $this->findFirstInstanceOf($stmts, Node\Stmt\Namespace_::class);
    }

    /**
     * @param Stmt[] $stmts
     * @return Node\Stmt\Namespace_[]
     */
    public function filterNameSpace(array $stmts): array
    {
        /* @phpstan-ignore-next-line */
        return $this->findInstanceOf($stmts, Node\Stmt\Namespace_::class);
    }

    /**
     * @param Stmt[] $stmts
     * @return Node\Stmt\ClassLike[]
     */
    public function filterClassLike(array $stmts): array
    {
        /* @phpstan-ignore-next-line */
        return $this->findInstanceOf($stmts, Node\Stmt\ClassLike::class);
    }
}
