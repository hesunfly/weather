<?php

namespace Hesunfly\Weather;

use GuzzleHttp\Client;
use Hesunfly\Weather\Exceptions\HttpException;

trait Request
{
    protected $statusCode;

    protected $header;

    protected function httpClient()
    {
        return new Client();
    }

    protected function get($url, $query)
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

    protected function statusCode()
    {
        return $this->statusCode;
    }

    protected function header()
    {
        return $this->header;
    }
}
