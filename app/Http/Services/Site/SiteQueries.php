<?php

namespace App\Http\Services\Site;

use App\Http\Services\Service;
use Exception;

class SiteQueries extends Service
{
    static function getData($type, string $params, int $key = null, array $options = [])
    {
        $setParam = static::setParamAPI([]);

        $url = sprintf('%s/%s', self::apiEndpointConfig(), $params . $setParam);

        $response = self::curlConfig()->request($type, $url, $options);

        $response = json_decode($response->getBody());

        throw_if(!$response, new Exception('Terjadi kesalahan: Data tidak dapat diperoleh ' . array_key_exists(500, static::$error_codes) ? 500 : null));

        if($key) {
            $result = collect(data_get($response, "data"))->where('number', $key)->first();
            $result ?? abort(404);
        } else {
            $result = collect(data_get($response, "data"));
        }

        return $result;
    }

    public static function getDataList($type, string $params)
    {
        return static::getData($type, $params);
    }

    public static function findById($type, string $params, int $key)
    {
        return static::getData($type, $params, $key);
    }
}
