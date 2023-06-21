<?php

namespace App\Helpers\ExternalApi;

use App\Exceptions\NotImplementedException;
use App\Helpers\BatchLogger;
use App\Helpers\DateHelper;
use App\Helpers\Responses\HttpStatuses;
use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use Illuminate\Http\Client\RequestException;

class HttpClient
{
    const TIMEOUT = 6;
    const CONNECT_TIMEOUT = 6;
    const ALLOW_REDIRECTS = false;
    const HTTP_ERROR = false;
    const VERIFY = false;
    const MAX_RETRY_ATTEMPTS = 3;
    const RETRY_DELAY_IN_MILLISECONDS = 1000;
    const HEADERS = ['Accept' => 'application/json', 'Content-Type' => 'application/json'];

    /**
     * Call an $url using GET method
     * @param string|null $url
     * @param mixed $params
     * @param mixed $options
     * @param string $channel
     * @return array<string, mixed>
     * @throws NotImplementedException
     */
    public static function get(string $url = null, $params, $options = [], string $channel = 'run_story'): array
    {
        try {
            $data = [];
            $stack = HandlerStack::create();
            $retryMiddleware = Middleware::retry(function (int $retryAttempts, $request, $response, $exception) {
                return $retryAttempts < self::MAX_RETRY_ATTEMPTS
                    && ($exception instanceof ConnectException
                        || ($response && $response->getStatusCode() >= HttpStatuses::HTTP_INTERNAL_SERVER_ERROR));
            }, function (int $retryAttempts) {
                return self::RETRY_DELAY_IN_MILLISECONDS * $retryAttempts;
            });
            $stack->push($retryMiddleware);
            $client = new Client(array_merge($options, ['handler' => $stack]));
            $response = $client->get($url , $params);
            $data = json_decode($response->getBody(), true);
            if ($response->getStatusCode() !== HttpStatuses::HTTP_OK) {
                BatchLogger::writeBatchLog($channel, DateHelper::parseWithTime(), "GET method: $url fail " . json_encode($data), json_encode($response->getBody()));
            }
            $data['statusCode'] = $response->getStatusCode();
            return $data;
        } catch (RequestException $e) {
            return [
                'statusCode' =>  $e->getCode(),
                'message' =>  $e->getMessage(),
            ];
        }
    }

    /**
     * Call an $url using POST method
     * @param string $url
     * @param mixed $params
     * @param mixed $options
     * @param string $channel
     * @return array<string, mixed>
     * @throws NotImplementedException
     */
    public static function post(string $url, mixed $params, mixed $options = [], string $channel = 'run_story'): array
    {
        try {
            $data = [];
            $stack = HandlerStack::create();
            $retryMiddleware = Middleware::retry(function ($retries, $request, $response, $exception) {
                return $retries < self::MAX_RETRY_ATTEMPTS && ($exception instanceof ConnectException ||
                    ($response && $response->getStatusCode() >= HttpStatuses::HTTP_INTERNAL_SERVER_ERROR));
            }, function ($retries) {
                return self::RETRY_DELAY_IN_MILLISECONDS * $retries;
            });
            $stack->push($retryMiddleware);
            $client = new Client(array_merge($options, ['handler' => $stack]));
            $response = $client->post($url, $params);
            $data = json_decode($response->getBody(), true);
            if ($response->getStatusCode() !== HttpStatuses::HTTP_OK) {
                BatchLogger::writeBatchLog($channel, Carbon::now()->format('Y-m-d H:i:s'), "Post method: $url fail " . json_encode($data), json_encode($response->getBody()));
            }
            $data['statusCode'] = $response->getStatusCode();
            return $data;
        } catch (RequestException $e) {
            return [
                'statusCode' =>  $e->getCode(),
                'message' =>  $e->getMessage(),
            ];
        }
    }

    /**
     * Call an $url using PUT method
     * @param string $url
     * @param mixed $params
     * @param mixed $options
     * @return mixed
     * @throws NotImplementedException
     */
    public function put(string $url, mixed $params, mixed $options = []): mixed
    {
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
    public function delete(string $url, mixed $params, mixed $options = []): mixed
    {
        // TODO: Have to code
        throw new NotImplementedException();
    }
}
