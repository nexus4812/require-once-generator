<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Application\Analyzer\Reflector;

use ReflectionClass;
use ReflectionNamedType;

readonly class ClassDependencyAnalyzer
{
    /**
     * 指定されたクラスの依存するクラスを再帰的に取得する
     *
     * @param ReflectionClass<object> $class 取得するクラス
     * @return array<int, string> 依存するクラスの配列
     */
    public function getClassDependencies(ReflectionClass $class): array
    {
        $dependencies = [
            ... $this->getConstructorDependencies($class),
            ...$this->getPropertyDependencies($class),
            ...$this->getMethodDependencies($class),
        ];
        return array_unique($dependencies);
    }

    /**
     * コンストラクタの依存するクラスを取得する
     *
     * @param ReflectionClass<object> $class 取得するクラス
     * @return array<int, string>
     */
    private function getConstructorDependencies(ReflectionClass $class): array
    {
        $dependencies = [];
        $constructor = $class->getConstructor();
        if ($constructor === null) {
            return $dependencies;
        }

        $params = $constructor->getParameters();
        foreach ($params as $param) {
            $type = $param->getType();
            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                $dependencies[] = $type->getName();
            }
        }

        return $dependencies;
    }

    /**
     * プロパティの依存するクラスを取得する
     *
     * @param ReflectionClass<object> $class 取得するクラス
     * @return array<int, string>
     */
    private function getPropertyDependencies(ReflectionClass $class): array
    {
        $dependencies = [];
        $properties = $class->getProperties();
        foreach ($properties as $property) {
            $type = $property->getType();
            if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                $dependencies[] = $type->getName();
            }
        }

        return $dependencies;
    }

    /**
     * メソッドの依存するクラスを取得する
     *
     * @param ReflectionClass<object> $class 取得するクラス
     * @return array<int, string>
     */
    private function getMethodDependencies(ReflectionClass $class): array
    {
        $dependencies = [];
        $methods = $class->getMethods();
        foreach ($methods as $method) {
            $params = $method->getParameters();

            foreach ($params as $param) {
                $type = $param->getType();
                if ($type instanceof ReflectionNamedType && !$type->isBuiltin()) {
                    $dependencies[] = $type->getName();
                }
            }
        }
        return $dependencies;
    }
}
