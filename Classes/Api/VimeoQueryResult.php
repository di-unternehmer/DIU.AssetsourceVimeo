<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:43
 */

namespace DIU\AssetSource\Vimeo\Api;


class VimeoQueryResult
{
    /**
     * @var \ArrayObject
     */
    protected $videos = [];

    /**
     * @var \ArrayIterator
     */
    protected $videoIterator;

    /**
     * @var int
     */
    protected $totalResults = 30;

    /**
     * @param array $videos
     * @param int $totalResults
     */
    public function __construct(array $videos, int $totalResults)
    {
        $this->videos = new \ArrayObject($videos);
        $this->videoIterator = $this->videos->getIterator();
        $this->totalResults = $totalResults;
    }

    /**
     * @return \ArrayObject
     */
    public function getvideos(): \ArrayObject
    {
        return $this->videos;
    }

    /**
     * @return \ArrayIterator
     */
    public function getvideoIterator(): \ArrayIterator
    {
        return $this->videoIterator;
    }

    /**
     * @return int
     */
    public function getTotalResults(): int
    {
        return $this->totalResults;
    }
}
