<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Analyzer\Reflector;

use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ClassDependencyAnalyzerTest extends TestCase
{
    private ClassDependencyAnalyzer $analyzer;

    protected function setUp(): void
    {

    }

    /**
     * @covers ClassDependencyAnalyzer
     */
    public function testGetClassDependencies(): void
    {
        $this->analyzer = new ClassDependencyAnalyzer();
        $expectedDependencies = [
            'RequireOnceGenerator\Application\Analyzer\Reflector\DummyClassA',
            'RequireOnceGenerator\Application\Analyzer\Reflector\DummyClassB',
            'RequireOnceGenerator\Application\Analyzer\Reflector\DummyClassC',
        ];

        $class = new ReflectionClass(DummyClassD::class);
        $actualDependencies = $this->analyzer->getClassDependencies($class);

        sort($expectedDependencies);
        sort($actualDependencies);

        static::assertSame($expectedDependencies, $actualDependencies);
    }
}

// FIXME: define in ClassDependencyAnalyzerTest

class DummyClassA
{
}
class DummyClassB
{
}
class DummyClassC
{
}

class DummyClassD
{
    private DummyClassA $a; /** @phpstan-ignore-line */
    private DummyClassB $b; /** @phpstan-ignore-line */

    public function __construct(DummyClassA $a, DummyClassB $b, DummyClassC $c) /** @phpstan-ignore-line */
    {
        $this->a = $a;
        $this->b = $b;
    }

    public function method1(DummyClassA $a, DummyClassB $b): void
    {
        $c = new DummyClassC();
    }

    public function method2(DummyClassC $c): void
    {
    }
}
