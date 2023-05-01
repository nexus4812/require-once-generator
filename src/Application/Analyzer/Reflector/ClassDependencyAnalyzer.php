<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Analyzer\Reflector;

use ReflectionClass;
use ReflectionUnionType;

class ClassDependencyAnalyzer
{
    private array $dependencies = [];

    /**
     * 指定されたクラスの依存するクラスを再帰的に取得する
     *
     * @param ReflectionClass $class 取得するクラス
     * @return array 依存するクラスの配列
     */
    public function getClassDependencies(ReflectionClass $class): array
    {
        $this->getConstructorDependencies($class);
        $this->getPropertyDependencies($class);
        $this->getMethodDependencies($class);
//        $this->resolveDependenciesRecursively();
        return array_unique($this->getDependencies());
    }

    /**
     * コンストラクタの依存するクラスを取得する
     *
     * @param ReflectionClass $class 取得するクラス
     */
    private function getConstructorDependencies(ReflectionClass $class): void
    {
        $constructor = $class->getConstructor();
        if ($constructor === null) {
            return;
        }

        $params = $constructor->getParameters();
        foreach ($params as $param) {
            $type = $param->getType();
            if ($type !== null && !$type->isBuiltin()) {
                $this->dependencies[] = $type->getName();
            }
        }
    }

    /**
     * プロパティの依存するクラスを取得する
     *
     * @param ReflectionClass $class 取得するクラス
     */
    private function getPropertyDependencies(ReflectionClass $class): void
    {
        $properties = $class->getProperties();
        foreach ($properties as $property) {
            $type = $property->getType();
            if ($type !== null && !$type->isBuiltin()) {
                $this->dependencies[] = $type->getName();
            }
        }
    }

    /**
     * メソッドの依存するクラスを取得する
     *
     * @param ReflectionClass $class 取得するクラス
     */
    private function getMethodDependencies(ReflectionClass $class): void
    {
        $methods = $class->getMethods();
        foreach ($methods as $method) {
            $params = $method->getParameters();

            foreach ($params as $param) {
                $reflectionIntersectionType = $param->getType();
                if ($reflectionIntersectionType === null || !method_exists($reflectionIntersectionType, 'getType')) {
                    continue;
                }

                $name = $reflectionIntersectionType->getName();

                if ($name !== null && !$reflectionIntersectionType->isBuiltin()) {
                    $this->dependencies[] = $name;
                }
            }
        }
    }

    /**
     * 依存するクラスを再帰的に解決する
     */
    private function resolveDependenciesRecursively(): void
    {
        $dependencies = $this->getDependencies();
        foreach ($dependencies as $dependency) {
            $class = new ReflectionClass($dependency);
            $this->getConstructorDependencies($class);
            $this->getPropertyDependencies($class);
            $this->getMethodDependencies($class);
        }
    }

    /**
     * 依存するクラスの配列を取得する
     *
     * @return array 依存するクラスの配列
     */
    private function getDependencies(): array
    {
        return $this->dependencies;
    }
}
