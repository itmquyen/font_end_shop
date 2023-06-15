<?php

namespace App\Helpers\Responses;

use App\DataResources\BaseDataResource;
use App\DataResources\IDataResource;
use App\Helpers\Enums\ResponseResults;

class Response
{
    private string $version = '1.0';
    private ?int $statusCode = null;
    private mixed $headers = ['Content-Type' => 'application/json'];
    private string $dataKey = 'message';
    private bool $resultState = ResponseResults::SUCCESS;

    public function __construct(string $version = '1.0')
    {
        $this->version = $version;
    }

    /**
     * Setup http status code
     * @param int $statusCode
     * @return $this
     */
    public function withStatusCode(int $statusCode = HttpStatuses::HTTP_OK): Response
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * Setup data key
     * @param string $dataKey
     * @return $this
     */
    public function withDataKey(string $dataKey = 'message'): Response
    {
        $this->dataKey = $dataKey;
        return $this;
    }

    /**
     * Setup result state
     * @param bool $state
     * @return $this
     */
    public function withResultState(bool $state = ResponseResults::SUCCESS): Response
    {
        $this->resultState = $state;
        return $this;
    }

    /**
     * Setup header
     * @param mixed $headers
     * @return $this
     */
    public function withHeaders(mixed $headers): Response
    {
        $this->headers = $headers;
        $this->headers['Content-Type'] = 'application/json';
        return $this;
    }


    /**
     * @param mixed $data
     * @param string|null $dataKey
     * @return mixed
     */
    public function send(mixed $data, string $dataKey = null): mixed
    {
        $dataKey = $dataKey ?? $this->dataKey;
        $data = ($data instanceof IDataResource) ?
            $data->toArray() :
            BaseDataResource::objectToArray($data);

        $content = [
            'version' => $this->version,
            'result' => $this->resultState,
            "data" => [
                "$dataKey" => $data
            ]
        ];

        $status = $this->statusCode ?? HttpStatuses::HTTP_OK;
        $headers = $this->headers;
        return response($content, $status, $headers);
    }

    /**
     * @param mixed $data
     * @param string $dataKey
     * @return mixed
     */
    public function success(mixed $data = [], string $dataKey = 'message'): mixed
    {
        $status = $this->statusCode ?? HttpStatuses::HTTP_OK;
        return $this->withDataKey($dataKey)
            ->withStatusCode($status)
            ->withResultState(true)
            ->send($data);
    }

    /**
     * @param mixed $data
     * @param string $dataKey
     * @return mixed
     */
    public function fail(mixed $data = [], string $dataKey = "errors"): mixed
    {
        $status = $this->statusCode ?? HttpStatuses::HTTP_INTERNAL_SERVER_ERROR;
        return $this->withDataKey($dataKey)
            ->withStatusCode($status)
            ->withResultState(false)
            ->send($data);
    }

    /**
     * @param bool $ret
     * @param mixed|null $data
     * @param string $dataKey
     * @return mixed
     */
    public function report(bool $ret, mixed $data = [], string $dataKey = "message"): mixed
    {
        return $ret ? $this->success($data, dataKey: $dataKey) : $this->fail($data, dataKey: $dataKey);
    }

    /**
     * @param bool $check
     * @param string $key
     * @return array
     */
    public function getMessage(bool $check, string $key = '=>'): mixed
    {
        if ($check) {
            return ["status" => trans('itm.message.success', ['attribute' => $key]), "icon" => "success"];
        }

        return ["status" => trans('itm.message.error', ['attribute' => $key]), "icon" => "error", 'is_error' => true];
    }

    /**
     * @return Response
     */
    public static function v1(): Response
    {
        return new Response('1.0');
    }
}