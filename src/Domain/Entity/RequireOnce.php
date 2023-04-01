<?php declare(strict_types=1);


namespace RequireOnceGenerator\Domain\Entity;

use RequireOnceGenerator\Domain\ValueObject\AbsolutePath;
use RequireOnceGenerator\Domain\ValueObject\LoadMethod;
use RequireOnceGenerator\Domain\ValueObject\RequireOncePrefix;

class RequireOnce
{
    public function __construct(
        private LoadMethod $loadMethod,
        private AbsolutePath $require_file_path,
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
            $this->prefix->toPrefixPath($this->require_file_path) :
            $this->require_file_path->value();

        return $this->loadMethod->createPHPCode($path);
    }
}
