<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Analyzer;


use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\NodeVisitorAbstract;

class DependencyVisitor extends NodeVisitorAbstract
{
    public function enterNode(Node $node)
    {
        if ($node instanceof New_) {
            $class = $node->class;
            if ($class instanceof Node\Name\FullyQualified) {
                $dependencies[] = $class->toString();
            }
        }

        return $dependencies;
    }

    public function getDependencies()
    {
        return $this->dependencies;
    }
}
