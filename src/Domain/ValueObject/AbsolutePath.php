<?php declare(strict_types=1);


namespace RequireOnceGenerator\Domain\ValueObject;


use SplFileInfo;

class AbsolutePath implements ValueObjectInterface, \Stringable
{
    public function __construct(private string $absolutePath)
    {
    }

    public static function createFromSplFileInfo(SplFileInfo $file): self
    {
        return new self($file->getRealPath(). '/'. $file->getFilename());
    }

    public function value(): string
    {
        return $this->absolutePath;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
