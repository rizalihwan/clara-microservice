<?php

namespace App\Http\Controllers;

use App\Http\Services\Site\SiteQueries;

class HomeController extends Controller
{
    public function __invoke()
    {
        try {
            $positive = SiteQueries::getDataByType('positif');
            $healed = SiteQueries::getDataByType('sembuh');
            $die = SiteQueries::getDataByType('meninggal');

            $data = [
                'positive' => $positive,
                'healed' => $healed,
                'die' => $die,
                'indonesia' => SiteQueries::getDataByType('indonesia')
            ];
        } catch (\Throwable $th) {
            return $this->errorMessageRespond("data tidak dapat di Peroleh {$th->getMessage()}", $th->getCode());
        }

        return view('home', compact('data'));
    }
}
