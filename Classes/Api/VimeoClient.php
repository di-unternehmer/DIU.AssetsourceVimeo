<?php
/**
 * Created by PhpStorm.
 * User: gordon-brueggemann
 * Date: 05.03.19
 * Time: 15:32
 */

namespace DIU\Assetsource\Vimeo\Api;


use Neos\Cache\Frontend\VariableFrontend;
use Neos\Flow\Annotations as Flow;
use Neos\Flow\ObjectManagement\Exception\UnresolvedDependenciesException;
use Vimeo\Exceptions\VimeoRequestException;
use Vimeo\Vimeo;

final class VimeoClient
{

    /**
     * @Flow\Inject
     * @var VariableFrontend
     */
    protected $videoPropertyCache;
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
     * @param string $identifier
     * @return mixed
     * @throws \Exception
     */
    public function findByIdentifier(string $identifier)
    {
        if (!$this->videoPropertyCache->has($identifier)) {
            throw new \Exception(sprintf('Video with id %s was not found in the cache', $identifier), 1525457755);
        }

        return $this->videoPropertyCache->get($identifier);
    }




    /**
     * @param int $page
     * @param int $per_page
     * @param string $query
     * @param string $sort
     * @param string $direction
     * @param string $filter

     */
    public function search(int $page = 1, int $per_page = 10, string $query = 'neos', string $filter = '', string $sort = 'relevant', string $direction = 'asc')
    {
        if(empty($query)){
            return new VimeoQueryResult([], 0, 1);
        }

        try {
         //   $response = $this->client->request('/tutorial', array(), 'GET');
            $response = $this->client->request(
                '/videos',
               [ 'query' => $query,
                   'page' => $page,
                   'per_page' => $per_page ]);

        //         //   'sort' => $sort,
        //          //  'direction' => $direction,
        //          //  'filter' => $filter,

         if ((int)$response['status'] === 200){
             return $this->processResult($response['body']);
     }

        }catch (VimeoRequestException $e){
            // @todo error logging
        }
        return new VimeoQueryResult([], 0, 1);

    }

    /**
     * @param array $resultArray
     * @return VimeoQueryResult
     * @throws \Neos\Cache\Exception
     */
    protected function processResult(array $resultArray): VimeoQueryResult
    {

        $videos = $resultArray['data'] ?? [];
        $totalResults = $resultArray['total'] ?? 30;
        $page = $resultArray['page'];


        foreach ($videos as $video) {
          //  $videoId = $this->extractIdFromUrlField($video);
            $this->videoPropertyCache->set($video['resource_key'], $video);
        }

         return new VimeoQueryResult($videos, $totalResults, $page);

    }

    /**
     * @param array $video
     * @return mixed
     */
    protected function extractIdFromUrlField(array $video){

        $videoUrlPath = explode('/',$video['uri']);
        return end( $videoUrlPath);
    }
}
