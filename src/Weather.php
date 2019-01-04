<?php

namespace Hesunfly\Weather;

use GuzzleHttp\Client;
use Hesunfly\Weather\Exception\HttpException;
use Hesunfly\Weather\Exception\InvalidArgumentException;

class Weather
{
    protected $key = null;

    public function __construct($key)
    {
        $this->key = $key;
    }

    /*public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions($options)
    {
        $this->guzzleOptions = $options;
    }*/

    public function getWeather($city, $extensions = "base", $output = "json")
    {
        $url = "https://restapi.amap.com/v3/weather/weatherInfo";

        if (!in_array(strtolower($extensions), ['base', 'all'])) {
            throw new InvalidArgumentException('不合法的请求参数: ' . $extensions);
        }

        if (!in_array(strtolower($output), ['json', 'xml'])) {
            throw new InvalidArgumentException('不合法的请求参数: ' . $output);
        }

        $params = [
            'key' => $this->key,
            'city' => $city,
            'extensions' => strtolower($extensions),
            'output' => strtolower($output)
        ];

        try {
            $httpClient = new Client();
            $response = $httpClient->get($url, ['params' => $params])->getBody()->getContents();

            return $output === 'json' ? json_decode($response, true) : $response;
        } catch (\Exception $exception) {
            throw new HttpException($exception->getMessage(), $exception->getCode(), $exception);
        }
    }
}
