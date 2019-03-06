<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:28
 */

namespace DIU\AssetSource\Vimeo\AssetSource;


use Neos\Media\Domain\Model\AssetSource\AssetProxyRepositoryInterface;
use Neos\Media\Domain\Model\AssetSource\AssetSourceInterface;

class VimeoAssetSource implements AssetSourceInterface
{

    /**
     * This factory method is used instead of a constructor in order to not dictate a __construct() signature in this
     * interface (which might conflict with an asset source's implementation or generated Flow proxy class).
     *
     * @param string $assetSourceIdentifier
     * @param array $assetSourceOptions
     * @return AssetSourceInterface
     */
    public static function createFromConfiguration(string $assetSourceIdentifier, array $assetSourceOptions): AssetSourceInterface
    {
        // TODO: Implement createFromConfiguration() method.
    }

    /**
     * A unique string which identifies the concrete asset source.
     * Must match /^[a-z][a-z0-9-]{0,62}[a-z]$/
     *
     * @return string
     */
    public function getIdentifier(): string
    {
        // TODO: Implement getIdentifier() method.
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        // TODO: Implement getLabel() method.
    }

    /**
     * @return AssetProxyRepositoryInterface
     */
    public function getAssetProxyRepository(): AssetProxyRepositoryInterface
    {
        // TODO: Implement getAssetProxyRepository() method.
    }

    /**
     * @return bool
     */
    public function isReadOnly(): bool
    {
        // TODO: Implement isReadOnly() method.
    }
}
