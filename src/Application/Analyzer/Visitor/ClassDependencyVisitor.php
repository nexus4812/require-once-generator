<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Analyzer\Visitor;

use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\NodeVisitorAbstract;

class ClassDependencyVisitor extends NodeVisitorAbstract
{
    /**
     * @var array<string, string>
     */
    private array $classes = [];
    private string $currentNamespace = '';

    /**
     * @var array <string, string>
     */
    private array $uses;

    public function enterNode(Node $node): void
    {
        if ($node instanceof Namespace_) {
            $this->currentNamespace = $node->name->toString() . '\\';
            return;
        }

        if ($node instanceof Use_) {
            foreach ($node->uses as $use) {
                $this->uses[$use->getAlias()->toString()] = $use->name->toString();
            }
            return;
        }

        if (
            (
                !$node instanceof Class_ &&
                !$node instanceof New_ &&
                !$node instanceof StaticCall
            ) ||
            !property_exists($node, 'class')
        ) {
            return;
        }

        $className = $node->class->toString();
        if (!$this->isFullyQualified($className) && $this->currentNamespace !== '') {
            $className = $this->currentNamespace . $className;
        }

        if (!\in_array($className, $this->classes, true)) {
            $this->classes[] = $className;
        }
    }

    /**
     * @return array<string, string>
     */
    public function getClasses(): array
    {
        return $this->classes;
    }

    private function isFullyQualified(string $className): bool
    {
        return str_starts_with($className, '\\');
    }

    public function getFullUseClass()
    {
        $result = [];
        foreach ($this->getClasses() as $class) {
            $result[] = \array_key_exists($class, $this->uses) ?
                $this->uses[$class] :
                $class;
        }

        return $result;
    }

    /**
     * @return array
     */
    public function getUses(): array
    {
        return $this->uses;
    }
}
