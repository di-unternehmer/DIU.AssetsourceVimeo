<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:27
 */

namespace DIU\Assetsource\Vimeo\AssetSource;

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\EntityManagerInterface;
use Neos\Flow\ObjectManagement\ObjectManagerInterface;
use Neos\Media\Domain\Model\AssetSource\AssetNotFoundExceptionInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxy\AssetProxyInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxyQueryResultInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxyRepositoryInterface;
use Neos\Media\Domain\Model\AssetSource\AssetSourceConnectionExceptionInterface;
use Neos\Media\Domain\Model\AssetSource\AssetTypeFilter;
use Neos\Media\Domain\Model\Tag;

class VimeoAssetProxyRepository implements AssetProxyRepositoryInterface
{

    /**
     * @var VimeoAssetSource
     */
    private $assetSource;
    /**
     * @Flow\Inject
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * @Flow\Inject
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * @param VimeoAssetSource $assetSource
     */
    public function __construct(VimeoAssetSource $assetSource)
    {
        $this->assetSource = $assetSource;
    }


    /**
     * @param string $identifier
     * @return AssetProxyInterface
     * @throws AssetNotFoundExceptionInterface
     * @throws AssetSourceConnectionExceptionInterface
     */
    public function getAssetProxy(string $identifier): AssetProxyInterface
    {
        return new VimeoAssetProxy($this->assetSource->getVimeoClient()->findByIdentifier($identifier), $this->assetSource);
    }

    /**
     * @param AssetTypeFilter $assetType
     */
    public function filterByType(AssetTypeFilter $assetType = null): void
    {
        // @description to add more Repository for more types VimeoVideo, VimeoThumbnails, Vimeo...
    }

    /**
     * @return AssetProxyQueryResultInterface
     * @throws AssetSourceConnectionExceptionInterface
     */
    public function findAll(): AssetProxyQueryResultInterface
    {
        $query = new VimeoAssetProxyQuery($this->assetSource);
        return $query->execute();
    }

    /**
     * @param string $searchTerm
     * @return AssetProxyQueryResultInterface
     */
    public function findBySearchTerm(string $searchTerm): AssetProxyQueryResultInterface
    {
        $query = new VimeoAssetProxyQuery($this->assetSource);
        $query->setSearchTerm($searchTerm);
        return $query->execute();
    }

    /**
     * @param Tag $tag
     * @return AssetProxyQueryResultInterface
     */
    public function findByTag(Tag $tag): AssetProxyQueryResultInterface
    {
        return $this->findBySearchTerm($tag);
    }

    /**
     * @return AssetProxyQueryResultInterface
     */
    public function findUntagged(): AssetProxyQueryResultInterface
    {
       throw new \Exception('is not implemented');
    }

    /**
     * Count all assets, regardless of tag or collection
     *
     * @return int
     */
    public function countAll(): int
    {
        return 99;
    }
}
