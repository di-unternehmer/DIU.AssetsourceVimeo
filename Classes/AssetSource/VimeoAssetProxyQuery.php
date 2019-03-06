<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:24
 */

namespace DIU\AssetSource\Vimeo\AssetSource;


use Neos\Media\Domain\Model\AssetSource\AssetProxyQueryInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxyQueryResultInterface;
use Neos\Media\Domain\Model\AssetSource\AssetSourceConnectionExceptionInterface;

class VimeoAssetProxyQuery  implements AssetProxyQueryInterface
{
    public function setOffset(int $offset): void
    {
        // TODO: Implement setOffset() method.
    }

    public function getOffset(): int
    {
        // TODO: Implement getOffset() method.
    }

    public function setLimit(int $limit): void
    {
        // TODO: Implement setLimit() method.
    }

    public function getLimit(): int
    {
        // TODO: Implement getLimit() method.
    }

    public function setSearchTerm(string $searchTerm)
    {
        // TODO: Implement setSearchTerm() method.
    }

    public function getSearchTerm()
    {
        // TODO: Implement getSearchTerm() method.
    }

    public function execute(): AssetProxyQueryResultInterface
    {
        // TODO: Implement execute() method.
    }

    public function count(): int
    {
        // TODO: Implement count() method.
    }

}
