<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Domain\Model\Entity;

use RequireOnceGenerator\Domain\Model\Collection\FileLoadContentsCollection;
use RequireOnceGenerator\Domain\Model\ValueObject\AbsolutePath;

class FileDependencyInfo
{
    public function __construct(
        private AbsolutePath $filePath,
        private FileLoadContentsCollection $requireOnces
    ) {
    }

    public static function createWithEmpty(AbsolutePath $filePath): self
    {
        return new self($filePath, new FileLoadContentsCollection());
    }

    public function addRequireOnce(FileLoadContents $string): void
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
