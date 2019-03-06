<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:32
 */

namespace DIU\AssetSource\Vimeo\Api;


use Neos\Cache\Frontend\VariableFrontend;
use Neos\Flow\Annotations as Flow;
use Vimeo\Exceptions\VimeoRequestException;
use Vimeo\Vimeo;

final class VimeoClient
{
    /**
     * @var Vimeo
     */
    protected $client;

    /**
     * @param string $clientId
     * @param string $clientSecret
     * @param string $accessToken
     */
    public function __construct(string $clientId, string $clientSecret, string $accessToken)
    {
        $this->client = new Vimeo($clientId, $clientSecret, $accessToken);
    }

    /**
     * @param int $page
     * @param int $per_page
     * @param string $query
     * @param string $sort
     * @param string $direction
     * @param string $filter
     * @param array $paging
     */
    public function search(int $page, int $per_page, string $query, string $sort, string $direction, string $filter, array $paging  ): void
    {

        try {
            $response = $this->client->request(
                '/videos',
                [
                    'page' => 1,
                    'per_page' => 10,
                    'query' => 'vimeo staff',
                    'sort' => 'relevant',
                    'direction' => 'desc',
                    'filter' => 'CC',
                    'paging' => [
                        'next' => '',
                        'previous' => '',
                        'first' => '',
                        'last' => '',
                    ]
                ]
            );
            $this->processResult($response);
        }catch (VimeoRequestException $e){
            // @todo error logging
        }

        print_r($response);
    }

    /**
     * @param array $resultArray
     * @return VimeoQueryResult
     * @throws \Neos\Cache\Exception
     */
    protected function processResult(array $resultArray): VimeoQueryResult
    {
        $photos = $resultArray['photos'] ?? [];
        $totalResults = $resultArray['total_results'] ?? 30;
        foreach ($photos as $photo) {
            if (isset($photo['id'])) {
                $this->photoPropertyCache->set($photo['id'], $photo);
            }
        }
        return new VimeoQueryResult($photos, $totalResults);
    }
}
