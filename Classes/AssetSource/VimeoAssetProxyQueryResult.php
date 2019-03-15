<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:26
 */

namespace DIU\Assetsource\Vimeo\AssetSource;


use DIU\Assetsource\Vimeo\Api\VimeoQueryResult;
use Neos\Media\Domain\Model\AssetSource\AssetProxy\AssetProxyInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxyQueryInterface;
use Neos\Media\Domain\Model\AssetSource\AssetProxyQueryResultInterface;

class VimeoAssetProxyQueryResult implements AssetProxyQueryResultInterface
{
    /**
     * @var VimeoAssetSource
     */
    private $assetSource;

    /**
     * @var VimeoQueryResult
     */
    private $vimeoQueryResult = [];


    /**
     * @var VimeoAssetProxyQuery
     */
    private $vimeoAssetProxyQuery;

    /**
     * @param VimeoAssetProxyQuery $query
     * @param VimeoQueryResult $vimeoQueryResult
     * @param VimeoAssetSource $assetSource
     */
    public function __construct(VimeoAssetProxyQuery $query, VimeoQueryResult $vimeoQueryResult, VimeoAssetSource $assetSource)
    {
        $this->vimeoAssetProxyQuery = $query;
        $this->assetSource = $assetSource;
        $this->vimeoQueryResult = $vimeoQueryResult;
    }
    /**
     * Returns a clone of the query object
     *
     * @return AssetProxyQueryInterface
     */
    public function getQuery(): AssetProxyQueryInterface
    {
        return clone $this->vimeoAssetProxyQuery;
    }

    /**
     * Returns the first asset proxy in the result set
     *
     * @return AssetProxyInterface|null
     */
    public function getFirst(): ?AssetProxyInterface
    {
        return $this->offsetGet(0);
    }

    /**
     * Returns an array with the asset proxies in the result set
     *
     * @return AssetProxyInterface[]
     */
    public function toArray(): array
    {
        return $this->vimeoQueryResult->getVideoIterator()->getArrayCopy();
    }

    /**
     * Return the current element
     * @link https://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     * @since 5.0.0
     */
    public function current()
    {
        $video = $this->vimeoQueryResult->getVideoIterator()->current();

        if(is_array($video)) {
            return new VimeoAssetProxy($video, $this->assetSource);
        } else {
            return null;
        }
    }

    /**
     * Move forward to next element
     * @link https://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function next()
    {
        $this->vimeoQueryResult->getVideoIterator()->next();
    }

    /**
     * Return the key of the current element
     * @link https://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     * @since 5.0.0
     */
    public function key()
    {
        return $this->vimeoQueryResult->getVideoIterator()->key();
    }

    /**
     * Checks if current position is valid
     * @link https://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return $this->vimeoQueryResult->getVideoIterator()->valid();
    }

    /**
     * Rewind the Iterator to the first element
     * @link https://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @since 5.0.0
     */
    public function rewind()
    {
        $this->vimeoQueryResult->getVideoIterator()->rewind();
    }

    /**
     * Whether a offset exists
     * @link https://php.net/manual/en/arrayaccess.offsetexists.php
     * @param mixed $offset <p>
     * An offset to check for.
     * </p>
     * @return boolean true on success or false on failure.
     * </p>
     * <p>
     * The return value will be casted to boolean if non-boolean was returned.
     * @since 5.0.0
     */
    public function offsetExists($offset)
    {
        return $this->vimeoQueryResult->getVideoIterator()->offsetExists($offset);
    }

    /**
     * Offset to retrieve
     * @link https://php.net/manual/en/arrayaccess.offsetget.php
     * @param mixed $offset <p>
     * The offset to retrieve.
     * </p>
     * @return mixed Can return all value types.
     * @since 5.0.0
     */
    public function offsetGet($offset)
    {
        return $this->vimeoQueryResult->getVideoIterator()->offsetGet($offset);
    }

    /**
     * Offset to set
     * @link https://php.net/manual/en/arrayaccess.offsetset.php
     * @param mixed $offset <p>
     * The offset to assign the value to.
     * </p>
     * @param mixed $value <p>
     * The value to set.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetSet($offset, $value)
    {
        $this->vimeoQueryResult->getVideoIterator()->offsetSet($offset, $value);
    }

    /**
     * Offset to unset
     * @link https://php.net/manual/en/arrayaccess.offsetunset.php
     * @param mixed $offset <p>
     * The offset to unset.
     * </p>
     * @return void
     * @since 5.0.0
     */
    public function offsetUnset($offset)
    {
        $this->vimeoQueryResult->getVideoIterator()->offsetUnset($offset);
    }

    /**
     * Count elements of an object
     * @link https://php.net/manual/en/countable.count.php
     * @return int The custom count as an integer.
     * </p>
     * <p>
     * The return value is cast to an integer.
     * @since 5.1.0
     */
    public function count()
    {
        return $this->vimeoQueryResult->getTotalResults();
    }
}
