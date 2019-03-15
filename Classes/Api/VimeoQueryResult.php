<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:43
 */

namespace DIU\Assetsource\Vimeo\Api;


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
     * @var int
     */
    private $page;


    /**
     * @param array $videos
     * @param int $totalResults
     * @param int $page
     */
    public function __construct(array $videos, int $totalResults, int $page)
    {
        $this->videos = new \ArrayObject($videos);
        $this->videoIterator = $this->videos->getIterator();
        $this->totalResults = $totalResults;
        $this->page = $page;
    }

    /**
     * @return \ArrayObject
     */
    public function getVideos(): \ArrayObject
    {
        return $this->videos;
    }

    /**
     * @return \ArrayIterator
     */
    public function getVideoIterator(): \ArrayIterator
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

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

}
