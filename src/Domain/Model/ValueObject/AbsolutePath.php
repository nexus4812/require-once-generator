<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Domain\Model\ValueObject;

use SplFileInfo;
use Stringable;

readonly class AbsolutePath implements ValueObjectInterface, Stringable
{
    public function __construct(private string $path)
    {
    }

    public static function createFromSplFileInfo(SplFileInfo $file): self
    {
        return new self($file->getRealPath(). '/'. $file->getFilename());
    }

    public function value(): string
    {
        return $this->path;
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
