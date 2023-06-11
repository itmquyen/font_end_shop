<?php
namespace App\Helpers\ExternalApi;

use App\Exceptions\NotImplementedException;
use Exception;
use GuzzleHttp\Client;
use PhpParser\Node\Stmt\Catch_;

class HttpClient{

    /**
     * Call an $url using GET method
     * @param string $url
     * @param mixed $params
     * @param mixed $options
     * @return mixed
     * @throws NotImplementedException
     */
    public function get(string $url, mixed $params, mixed $options=[]): mixed{
        try{
            $client = new Client();
            $response = $client->get($url,$options);
            return json_decode($response->getBody()->getContents(),true);
        }catch(Exception $e){

        }
        throw new \Nette\NotImplementedException();
    }

    /**
     * Call an $url using POST method
     * @param string $url
     * @param mixed $params
     * @param mixed $options
     * @return mixed
     * @throws NotImplementedException
     */
    public function post(string $url, mixed $params, mixed $options=[]): mixed{
        // TODO: Have to code
        throw new \Nette\NotImplementedException();
    }

    /**
     * Call an $url using PUT method
     * @param string $url
     * @param mixed $params
     * @param mixed $options
     * @return mixed
     * @throws NotImplementedException
     */
    public function put(string $url, mixed $params, mixed $options=[]): mixed{
        // TODO: Have to code
        throw new NotImplementedException();
    }

    /**
     * Call an $url using DELETE method
     * @param string $url
     * @param mixed $params
     * @param mixed $options
     * @return mixed
     * @throws NotImplementedException
     */
    public function delete(string $url, mixed $params, mixed $options=[]): mixed{
        // TODO: Have to code
        throw new NotImplementedException();
    }
}
