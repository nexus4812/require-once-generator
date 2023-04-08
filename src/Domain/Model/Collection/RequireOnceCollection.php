<?php declare(strict_types=1);

namespace RequireOnceGenerator\Domain\Model\Collection;

use RequireOnceGenerator\Domain\Model\Entity\FileLoadContents;

/**
 * @extends ObjectCollection<int, FileLoadContents>
 */
class RequireOnceCollection extends ObjectCollection
{
    protected string $className = FileLoadContents::class;
}
