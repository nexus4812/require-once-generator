<?php

require_once __DIR__ . '/vendor/autoload.php';

use PhpParser\Node;
use PhpParser\Node\Expr\New_;
use PhpParser\Node\Expr\StaticCall;
use PhpParser\Node\Stmt\Class_;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Stmt\Use_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;

class ClassDependencyVisitor extends NodeVisitorAbstract
{
    private array $classes = [];
    private string $currentNamespace = '';
    private array $uses;

    public function enterNode(Node $node)
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

        if (!$node instanceof Class_ && !$node instanceof New_ && !$node instanceof StaticCall) {
            return;
        }

        $className = $node->class->toString();
        if (!$this->isFullyQualified($className) && $this->currentNamespace !== '') {
            $className = $this->currentNamespace . $className;
        }

        if (!in_array($className, $this->classes)) {
            $this->classes[] = $className;
        }
    }

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
            $result[] = array_key_exists($class, $this->uses) ?
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

// 実行例
$code = <<<'CODE'
<?php

namespace Hoge;

use Foo\Bar;
use Baz\Qux;

$bar = new Bar();
$qux = new Qux();
$qux = new Baz\Quee();
$unknown = new Unknown();

$class = MYSAMPLE::NAME();

$qux = new QQQaaa();
CODE;

// $code = file_get_contents(__DIR__ . '/test.php'); // test.phpファイルの内容を取得

$parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7);
try {
    $stmts = $parser->parse($code);
} catch (Error $e) {
    echo 'Parse Error: ', $e->getMessage();
}

$traverser = new NodeTraverser();
$visitor = new ClassDependencyVisitor();
$traverser->addVisitor($visitor);

$traverser->traverse($stmts);

print_r($visitor->getClasses());
print_r($visitor->getUses());
print_r($visitor->getFullUseClass());
