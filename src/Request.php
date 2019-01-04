<?php

namespace Hesunfly\Weather;

use GuzzleHttp\Client;

class Request
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function get($url, $query)
    {
        $response = $this->client->get($url, ['query' => $query]);

        return [
            'statusCode' => $response->getStatusCode(),
            'header' => $response->getHeader('content-type'),
            'body' => $response->getBody()->getContents()
        ];
    }
}