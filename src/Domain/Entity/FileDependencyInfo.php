<?php declare(strict_types=1);


namespace RequireOnceGeneratorDomain\Entity;


use JetBrains\PhpStorm\ArrayShape;
use RequireOnceGeneratorDomain\Collection\RequireOnceCollection;
use RequireOnceGeneratorDomain\ValueObject\AbsolutePath;

class FileDependencyInfo
{
    public function __construct(
        private AbsolutePath $filePath,
        private RequireOnceCollection $require_onces
    )
    {
    }

    public static function createWithEmpty(AbsolutePath $filePath): self
    {
        return new self($filePath, new RequireOnceCollection());
    }

    public function addRequireOnce(RequireOnce $string): void
    {
        $this->require_onces->add($string);
    }

    /**
     * for debug method
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'file_path' => $this->filePath,
            'require_onces' => $this->require_onces,
        ];
    }
}
