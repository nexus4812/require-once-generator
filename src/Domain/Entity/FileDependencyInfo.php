<?php declare(strict_types=1);


namespace RequireOnceGenerator\Domain\Entity;


use RequireOnceGenerator\Domain\Collection\RequireOnceCollection;
use RequireOnceGenerator\Domain\ValueObject\AbsolutePath;

class FileDependencyInfo
{
    public function __construct(
        private AbsolutePath $filePath,
        private RequireOnceCollection $requireOnces
    )
    {
    }

    public static function createWithEmpty(AbsolutePath $filePath): self
    {
        return new self($filePath, new RequireOnceCollection());
    }

    public function addRequireOnce(RequireOnce $string): void
    {
        $this->requireOnces->add($string);
    }

    /**
     * for debug method
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'file_path' => $this->filePath,
            'require_onces' => $this->requireOnces,
        ];
    }
}
