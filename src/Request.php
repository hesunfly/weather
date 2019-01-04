<?php

namespace Hesunfly\Weather;

use GuzzleHttp\Client;
use Hesunfly\Weather\Exception\HttpException;

trait Request
{
    public $statusCode;

    public $header;

    public function httpClient()
    {
       return new Client();
    }

    public function get($url, $query)
    {
        try {
            $response = $this->httpClient()->get($url, ['query' => $query]);
            $this->statusCode = $response->getStatusCode();
            $this->header = $response->getHeader('content-type');

            return $response->getBody()->getContents();
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }

    public function statusCode()
    {
        return $this->statusCode;
    }

    public function header()
    {
        return $this->header;
    }

}