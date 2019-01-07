<?php

namespace Hesunfly\Weather;

use Hesunfly\Weather\Exceptions\InvalidArgumentException;

class Weather
{
    use Request;

    private $key = null;

    private $url = 'https://restapi.amap.com/v3/weather/weatherInfo';

    public function __construct($key)
    {
        $this->key = $key;
    }

    public function currenct($city, $output = 'json')
    {
        return $this->weather($city, 'base', $output);
    }

    public function forecast($city, $output = 'json')
    {
        return $this->weather($city, 'all', $output);
    }

    private function weather($city, $type, $output)
    {
        if (!in_array(strtolower($output), ['json', 'xml'])) {
            throw new InvalidArgumentException('不合法的请求参数: '.$output);
        }

        $params = [
            'key' => $this->key,
            'city' => $city,
            'extensions' => $type,
            'output' => strtolower($output),
        ];

        $response = $this->get($this->url, $params);

        return 'json' === $output ? json_decode($response, true) : $response;
    }
}
