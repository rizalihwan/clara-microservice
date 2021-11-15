<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Site\SiteQueries;

class SiteApiController extends Controller
{
    public function index()
    {
        try {
            $data = SiteQueries::getData('GET', 'surah');
            if (empty($data)) return back();
            else $data;
        } catch (\Throwable $err) {
            return "Error: data tidak dapat di Peroleh {$err->getMessage()} Status code : {$err->getCode()}";
        }

        return view('sites', compact('data'));
    }
}
