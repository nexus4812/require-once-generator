<?php declare(strict_types=1);


namespace RequireOnceGenerator\Domain\ValueObject;


class RequireOncePrefix implements ValueObjectInterface
{
    public function __construct(
        private string $prefix,
        private AbsolutePath $replace_path
    )
    {
    }

    public function value(): string
    {
        return $this->prefix;
    }

    public function toPrefixPath(AbsolutePath $path): string
    {
        $relativePath = str_replace($this->replace_path->value(), '', $path->value()) ?: '';
        return $this->prefix . '/' . $relativePath;
    }
}
