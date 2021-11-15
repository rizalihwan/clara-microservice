<?php

namespace App\Http\Services\Site;

use App\Http\Services\Service;
use Exception;

class SiteQueries extends Service
{
    public static function getData($type, string $params = null, array $options = [])
    {
        $setParam = static::setParamAPI([]);

        $url = sprintf('%s/%s', self::apiEndpointConfig(), $params . $setParam);

        $response = self::curlConfig()->request($type, $url, $options);

        $response = json_decode($response->getBody());

        throw_if(!$response, new Exception('Terjadi kesalahan: Data tidak dapat diperoleh'));

        $result = collect(data_get($response, "data"));

        return static::withPaginate($result->toArray(), 10, 1);
    }
}
