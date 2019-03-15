<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:24
 */

namespace DIU\Assetsource\Vimeo\AssetSource;


use Neos\Media\Domain\Model\AssetSource\AssetProxyQueryInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxyQueryResultInterface;


class VimeoAssetProxyQuery  implements AssetProxyQueryInterface
{
    /**
     * @var VimeoAssetSource
     */
    private $assetSource;

    /**
     * @var int
     */
    private $limit = 20;

    /**
     * @var int
     */
    private $offset = 0;

    /**
     * @var string
     */
    private $searchTerm = '';

    /**
     * UnsplashAssetProxyQuery constructor.
     * @param VimeoAssetSource $assetSource
     */
    public function __construct(VimeoAssetSource $assetSource)
    {
        $this->assetSource = $assetSource;
    }

    public function setOffset(int $offset): void
    {
        $this->offset = $offset;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function setSearchTerm(string $searchTerm)
    {
        $this->searchTerm = $searchTerm;
    }

    public function getSearchTerm()
    {
        return $this->searchTerm;
    }

    public function execute(): AssetProxyQueryResultInterface
    {
       $page = (int) ceil(($this->offset + 1) / $this->limit);
       $video = $this->assetSource->getVimeoClient()->search(
           $page,
           $this->limit,
           $this->searchTerm
           );


        return new VimeoAssetProxyQueryResult($this, $video, $this->assetSource);
    }

    public function count(): int
    {
        // TODO: Implement count() method.
    }

}
