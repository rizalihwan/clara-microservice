<?php

namespace App\Http\Services\Site;

use App\Http\Services\Service;
use Exception;

class SiteQueries extends Service
{
    static function getDataQuran($type, string $params, int $key = null, array $options = [])
    {
        $setParam = static::setParamAPI([]);

        $url = sprintf('%s/%s', self::apiEndpointConfig(config('credentials.third_party_api.quranapi')), $params . $setParam);

        $response = self::curlConfig()->request($type, $url, $options);

        $response = json_decode($response->getBody());

        throw_if(!$response, new Exception('Terjadi kesalahan: Data tidak dapat diperoleh ' . array_key_exists(500, static::$error_codes) ? 500 : null));

        if ($key) {
            $result = collect(data_get($response, "data"))->where('number', $key)->first();
            $result ?? abort(404);
        } else {
            $result = collect(data_get($response, "data"));
        }

        return $result;
    }

    public static function getDataList($type, string $params)
    {
        return static::getDataQuran($type, $params);
    }

    public static function findById($type, string $params, int $key)
    {
        return static::getDataQuran($type, $params, $key);
    }

    static function getDataCovid($type, string $params = null, array $options = [])
    {
        $setParam = static::setParamAPI([]);

        $url = sprintf('%s/%s', self::apiEndpointConfig(config('credentials.third_party_api.covidapi')), $params . $setParam);

        $response = self::curlConfig()->request($type, $url, $options);

        $response = json_decode($response->getBody());

        throw_if(!$response, new Exception('Terjadi kesalahan: Data tidak dapat diperoleh ' . array_key_exists(500, static::$error_codes) ? 500 : null));

        return $response;
    }

    public static function getDataByType($type)
    {
        return collect(static::getDataCovid('GET', $type));
    }

    static function getTripayData($type, string $params = null, array $options = [])
    {
        $setParam = static::setParamAPI([]);

        $url = sprintf('%s/%s', self::apiEndpointConfig(config('credentials.third_party_api.tripay')), $params . $setParam);

        $response = self::curlConfig()->request($type, $url, $options);

        $response = json_decode($response->getBody());

        throw_if(!$response, new Exception('Terjadi kesalahan: Data tidak dapat diperoleh ' . array_key_exists(500, static::$error_codes) ? 500 : null));

        return $response;
    }
}
