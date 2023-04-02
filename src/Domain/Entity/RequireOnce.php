<?php declare(strict_types=1);


namespace RequireOnceGenerator\Domain\Entity;

use RequireOnceGenerator\Domain\ValueObject\AbsolutePath;
use RequireOnceGenerator\Domain\ValueObject\LoadMethod;
use RequireOnceGenerator\Domain\ValueObject\RequireOncePrefix;

class RequireOnce
{
    public function __construct(
        private LoadMethod $loadMethod,
        private AbsolutePath $requireFilePath,
        private RequireOncePrefix|null $prefix
    )
    {
    }

    /**
     * Create Require once code
     * ex. require_once PROJECT_ROOT . 'src/Controller/MyPageController';
     *
     * @return string
     */
    public function createPHPCode(): string
    {
        $path = $this->prefix ?
            $this->prefix->toPrefixPath($this->requireFilePath) :
            $this->requireFilePath->value();

        return $this->loadMethod->createPHPCode($path);
    }
}
