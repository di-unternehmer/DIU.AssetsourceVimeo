<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 11.03.19
 * Time: 10:37
 */

namespace DIU\Assetsource\Vimeo\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\ResourceManagement\PersistentResource;
use Neos\Media\Domain\Model\ImageInterface;
use Neos\Media\Domain\Model\Asset;
use Neos\Media\Domain\Model\Video;

/**
* @Flow\Entity
* @ORM\InheritanceType("JOINED")
*/

class Vimeo extends Video implements ImageInterface
{
    /**
     * Constructs the object and sets default values for width and height
     *
     * @param PersistentResource $resource
     */
    public function __construct(PersistentResource $resource)
    {
        parent::__construct($resource);
        $filePath = explode('.',$resource->getFilename());
        $this->setVideoId($filePath[0]);

        $this->width = -1;
        $this->height = -1;
    }

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    protected $videoId = 0;

    /**
     * @return int
     */
    public function getVideoId(): int
    {
        return $this->videoId;
    }

    /**
     * @param int $videoId
     */
    public function setVideoId(int $videoId): void
    {
        $this->videoId = $videoId;
    }


    /**
     * @return integer
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return integer
     */
    public function getHeight()
    {
        return $this->height;
    }

    public function getAspectRatio($respectOrientation = false)
    {
        return $respectOrientation;
    }

    public function isOrientationSquare()
    {
        return false;
    }

    public function isOrientationLandscape()
    {
        return true;
    }

    public function isOrientationPortrait()
    {
        return false;
    }

    public function getOrientation()
    {
        return ImageInterface::ORIENTATION_LANDSCAPE;
    }


}
