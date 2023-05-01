<?php declare(strict_types=1);


namespace RequireOnceGenerator\Application\Analyzer;

use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Stmt\Class_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use RequireOnceGenerator\Application\Config\GeneratorConfigInterface;
use RequireOnceGenerator\Application\Parser\NodeCollectionFactory;
use RequireOnceGenerator\Domain\Model\Entity\FileDependencyInfo;
use RequireOnceGenerator\Domain\Model\ValueObject\AbsolutePath;
use SplFileInfo;

class GenerateRequireOnce
{
    public function __construct(
        private GeneratorConfigInterface $config,
        private NodeCollectionFactory $nodesFactory
    )
    {
    }

    public function create(): void
    {
        $class = require $this->config->getClassListCachePath();

        /** @var SplFileInfo $file */
        foreach ($this->config->getTargetFinder() as $file) {
            $absolutePath = AbsolutePath::createFromSplFileInfo($file);
            $nodes = $this->nodesFactory->createFromAbsolutePath($absolutePath);

            $visitor = new class() extends NodeVisitorAbstract {
                public $classes = [];

                public function enterNode(Node $node): void {
                    if ($node instanceof Class_) {
                        $this->classes[] = $node->namespacedName->toString();
                    } elseif ($node instanceof New_) {
                        $className = $node->class->toString();
                        if (!\in_array($className, $this->classes, true)) {
                            $this->classes[] = $className;
                        }
                    } elseif ($node instanceof StaticCall) {
                        $className = $node->class->toString();
                        if (!\in_array($className, $this->classes, true)) {
                            $this->classes[] = $className;
                        }
                    }
                }
            };

            $traverser = new NodeTraverser();
            $traverser->addVisitor($visitor);
            $traverser->traverse($stmts);
        }
    }
}
