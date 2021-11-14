<?php

namespace App\Http\Services;

use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;

class Service
{
    static $apiEndpoint;
    static $curl;
    static $error_codes = [400, 401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 421, 422, 423, 424, 425, 426, 428, 429, 431, 451, 500, 501, 502, 503, 504, 505, 506, 507, 508, 510, 511];

    static function initSetStatic($check, $value)
    {
        if (is_null($check)) {
            $value = $value;
        }

        return $value;
    }

    public static function curlConfig()
    {
        return static::initSetStatic(self::$curl, new Client());
    }

    public static function apiEndpointConfig()
    {
        return static::initSetStatic(self::$apiEndpoint, config('credentials.quranapi'));
    }

    static function setParamAPI($data = [])
    {
        $param = [];
        $index = 0;
        $len = count($data);

        foreach ($data as $key => $value) {
            $value = preg_replace('/\s+/', '+', $value);

            if ($index == 0) {
                $param[] = sprintf('?%s=%s', $key, $value);
            } else {
                $param[] = sprintf('&%s=%s', $key, $value);
            }

            $index++;
        }

        return implode('', $param);
    }

    static function paginateKuy(array $items, $perPage = 10, $page = 1, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);

        $paginated = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
        $modified = [];
        foreach ($paginated->items() as $key) {
            array_push($modified, $key);
        }

        return [
            'current_page'    => $paginated->currentPage(),
            'data'            => $modified,
            'first_page_url'  => "/?page=1",
            'from'            => $paginated->firstItem(),
            'last_page'       => $paginated->lastPage(),
            'last_page_url'   => "/?page=" . $paginated->lastPage(),
            'links'           => $paginated->linkCollection(),
            'next_page_url'   => $paginated->nextPageUrl(),
            'path'            => $paginated->path(),
            'per_page'        => $paginated->perPage(),
            'prev_page_url'   => $paginated->previousPageUrl(),
            'to'              => count($modified),
            'total'           => $paginated->total()
        ];
    }
}
