<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:16
 */

namespace DIU\Assetsource\Vimeo\AssetSource;

use Neos\Flow\Annotations as Flow;
use Neos\ContentRepository\Utility;
use Neos\Eel\EelEvaluatorInterface;
use Neos\Flow\Http\Uri;
use Neos\Media\Domain\Model\AssetSource\AssetProxy\AssetProxyInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxy\HasRemoteOriginalInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxy\SupportsIptcMetadataInterface;
use Neos\Media\Domain\Model\AssetSource\AssetSourceInterface;
use Neos\Media\Domain\Model\ImportedAsset;
use Neos\Media\Domain\Repository\ImportedAssetRepository;
use Psr\Http\Message\UriInterface;

class VimeoAssetProxy implements AssetProxyInterface, HasRemoteOriginalInterface, SupportsIptcMetadataInterface
{
    /**
     * @var array
     */
    private $video;

    /**
     * @var VimeoAssetSource
     */
    private $assetSource;

    /**
     * @var ImportedAsset
     */
    private $importedAsset;

    /**
     * @var array
     */
    private $iptcProperties;

    /**
     * @var array
     * @Flow\InjectConfiguration(path="defaultContext", package="Neos.Fusion")
     */
    protected $defaultContextConfiguration;

    /**
     * @var EelEvaluatorInterface
     * @Flow\Inject(lazy=false)
     */
    protected $eelEvaluator;

    /**
     * @Flow\InjectConfiguration(package="Neos.Media")
     * @var array
     */
    protected $mediaConfiguration = array();

    /**
     * UnsplashAssetProxy constructor.
     * @param array $video
     * @param VimeoAssetSource $assetSource
     */
    public function __construct(array $video, VimeoAssetSource $assetSource)
    {
        $this->video = $video;
        $this->assetSource = $assetSource;
        $this->importedAsset = (new ImportedAssetRepository)->findOneByAssetSourceIdentifierAndRemoteAssetIdentifier($assetSource->getIdentifier(), $this->getIdentifier());
    }

    public function getAssetSource(): AssetSourceInterface
    {
        return $this->assetSource;
    }

    public function getIdentifier(): string
    {
        return (string)$this->getProperty('resource_key');
    }

    public function getLabel(): string
    {
        return $this->getProperty('name');
    }
    public function getCaption(){
        return $this->getProperty('description');
    }

    public function getFilename(): string
    {
        return str_replace('/videos/','',$this->getProperty('uri')).'.vimeo';
    }

    public function getLastModified(): \DateTimeInterface
    {
        return new \DateTime($this->getProperty('modified_time'));
    }

    public function getFileSize(): int
    {

       return 0;

    }

    public function getMediaType(): string
    {
        return 'vimeo/video';
    }

    public function getWidthInPixels(): ?int
    {
        return $this->getProperty('width');
    }

    public function getHeightInPixels(): ?int
    {
        return $this->getProperty('height');
    }

    public function getThumbnailUri(): ?UriInterface
    {
        foreach ($this->video['pictures']['sizes'] as $picture){
            //@todo get picture size for view from settings
            if( (int)$picture['width'] === 640 ){
                return new Uri($picture['link_with_play_button']);
            }
        }
        return new Uri(end($this->getProperty('pictures')['sizes'])['link_with_play_button']);
    }

    public function getPreviewUri(): ?UriInterface
    {
        return new Uri(end($this->getProperty('pictures')['sizes'])['link_with_play_button']);

        // @decripton  The same as original
       // return new Uri ($this->mediaConfiguration['assetSources']['vimeo']['playerDomain'].$this->getProperty('uri'));
    }

    public function getImportStream()
    {
        return $this->getPreviewUri();
       // return $this->mediaConfiguration['assetSources']['vimeo']['playerDomain'].str_replace('s','',$this->getProperty('uri'));

    }

    public function getLocalAssetIdentifier(): ?string
    {
        return $this->importedAsset instanceof ImportedAsset ? $this->importedAsset->getLocalAssetIdentifier() : '';
    }

    public function isImported(): bool
    {
        return $this->importedAsset !== null;
    }

    /**
     * @param string $propertyName
     * @return bool
     */
    public function hasIptcProperty(string $propertyName): bool
    {
        return isset($this->getIptcProperties()[$propertyName]);
    }

    /**
     * @param string $propertyName
     * @return string
     */
    public function getIptcProperty(string $propertyName): string
    {
        return $this->getIptcProperties()[$propertyName] ?? '';
    }

    public function getIptcProperties(): array
    {
        if ($this->iptcProperties === null) {
            $this->iptcProperties = [
                'Title' => $this->getLabel()
                ,'CaptionAbstract' => $this->getCaption()
            //    ,'CopyrightNotice' => $this->compileCopyrightNotice(['name' => $this->getProperty('photographer')]),
            ];
        }

        return $this->iptcProperties;
    }

    /**
     * @param array $userProperties
     * @return string
     * @throws \Neos\Eel\Exception
     */
    protected function compileCopyrightNotice(array $userProperties): string
    {
        return Utility::evaluateEelExpression($this->assetSource->getCopyRightNoticeTemplate(), $this->eelEvaluator, ['user' => $userProperties], $this->defaultContextConfiguration);
    }

    /**
     * @param string $propertyName
     * @return mixed|null
     */
    protected function getProperty(string $propertyName)
    {
        return $this->video[$propertyName] ?? null;
    }
}
