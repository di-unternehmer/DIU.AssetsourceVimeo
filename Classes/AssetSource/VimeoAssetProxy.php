<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:16
 */

namespace DIU\AssetSource\Vimeo\AssetSource;


use Neos\Media\Domain\Model\AssetSource\AssetProxy\AssetProxyInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxy\HasRemoteOriginalInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxy\SupportsIptcMetadataInterface;
use Neos\Media\Domain\Model\AssetSource\AssetSourceInterface;
use Psr\Http\Message\UriInterface;

class VimeoAssetProxy implements AssetProxyInterface, HasRemoteOriginalInterface, SupportsIptcMetadataInterface
{
    public function getAssetSource(): AssetSourceInterface
    {
        // TODO: Implement getAssetSource() method.
    }

    public function getIdentifier(): string
    {
        // TODO: Implement getIdentifier() method.
    }

    public function getLabel(): string
    {
        // TODO: Implement getLabel() method.
    }

    public function getFilename(): string
    {
        // TODO: Implement getFilename() method.
    }

    public function getLastModified(): \DateTimeInterface
    {
        // TODO: Implement getLastModified() method.
    }

    public function getFileSize(): int
    {
        // TODO: Implement getFileSize() method.
    }

    public function getMediaType(): string
    {
        // TODO: Implement getMediaType() method.
    }

    public function getWidthInPixels(): ?int
    {
        // TODO: Implement getWidthInPixels() method.
    }

    public function getHeightInPixels(): ?int
    {
        // TODO: Implement getHeightInPixels() method.
    }

    public function getThumbnailUri(): ?UriInterface
    {
        // TODO: Implement getThumbnailUri() method.
    }

    public function getPreviewUri(): ?UriInterface
    {
        // TODO: Implement getPreviewUri() method.
    }

    public function getImportStream()
    {
        // TODO: Implement getImportStream() method.
    }

    public function getLocalAssetIdentifier(): ?string
    {
        // TODO: Implement getLocalAssetIdentifier() method.
    }

    public function isImported(): bool
    {
        // TODO: Implement isImported() method.
    }

    /**
     * @param string $propertyName
     * @return bool
     */
    public function hasIptcProperty(string $propertyName): bool
    {
        // TODO: Implement hasIptcProperty() method.
    }

    /**
     * @param string $propertyName
     * @return string
     */
    public function getIptcProperty(string $propertyName): string
    {
        // TODO: Implement getIptcProperty() method.
    }

    public function getIptcProperties(): array
    {
        // TODO: Implement getIptcProperties() method.
    }


}
