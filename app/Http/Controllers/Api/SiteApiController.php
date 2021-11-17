<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Site\SiteQueries;

class SiteApiController extends Controller
{
    public function index()
    {
        try {
            $data = SiteQueries::getDataList('GET', 'surah');

            if (empty($data)) return back();
            else
                $data = $data->map(function ($item) {
                    return [
                        'id' => $item->number,
                        'name' => $item->name->short,
                        'id_name' => $item->name->transliteration->id
                    ];
                });
        } catch (\Throwable $th) {
            return "Error: data tidak dapat di Peroleh {$th->getMessage()} Status code : {$th->getCode()}";
        }

        return view('sites', compact('data'));
    }

    public function detail($id)
    {
        $data = SiteQueries::findById('GET', 'surah', $id);

        if ($data) {
            try {
                $data = [
                    'id' => $data->number,
                    'name' => $data->name->short,
                    'id_name' => $data->name->transliteration->id
                ];
            } catch (\Exception $ex) {
                return "Error: data tidak dapat di Peroleh {$ex->getMessage()} Status code : {$ex->getCode()}";
            } catch (\Error $err) {
                return "Error: {$err->getMessage()}";
            }
        } else {
            abort(404);
        }

        return view('detailsites', compact('data'));
    }
}
