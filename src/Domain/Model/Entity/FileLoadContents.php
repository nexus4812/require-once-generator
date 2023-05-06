<?php

declare(strict_types=1);

namespace RequireOnceGenerator\Domain\Model\Entity;

use RequireOnceGenerator\Domain\Model\ValueObject\AbsolutePath;
use RequireOnceGenerator\Domain\Model\ValueObject\LoadMethod;
use RequireOnceGenerator\Domain\Model\ValueObject\LoadDirectoryPrefix;

readonly class FileLoadContents
{
    public function __construct(
        private LoadMethod $loadMethod,
        private AbsolutePath $requireFilePath,
        private LoadDirectoryPrefix|null $prefix
    ) {
    }

    /**
     * Create require once code
     * ex. require_once PROJECT_ROOT . 'src/Controller/MyPageController';
     * ex. include_once '/home/my/project/src/Controller/MyPageController';
     *
     * @return string
     */
    public function createPHPCode(): string
    {
        $path = $this->prefix !== null ?
            $this->prefix->toPrefixPath($this->requireFilePath) :
            $this->requireFilePath->value();

        return $this->loadMethod->createPHPCode($path);
    }
}
