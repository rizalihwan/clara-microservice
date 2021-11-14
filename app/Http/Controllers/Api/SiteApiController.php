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
        } catch (\Exception $e) {
            return 'Error: ' . $e->getMessage();
        }

        return view('sites', compact('data'));
    }

    // public function coronaApi()
    // {
    //     $coronaApi = 'https://api.kawalcorona.com/indonesia/provinsi';
    //     $client = new Client();

    //     $dataCoronaIndonesia = $client->request('GET', $coronaApi);
    //     $getCoronaApi = collect(json_decode($dataCoronaIndonesia->getBody()->getContents()));

    //     return view('corona', [
    //         'data' => $getCoronaApi
    //     ]);
    // }

    // public function store()
    // {
    //     try {
    //         $response = $this->getApiData('POST', [
    //             'headers' => ['Content-Type'  => 'application/json'],
    //             'json' => [
    //                 'title' => request('title'),
    //                 'body' => request('body'),
    //                 'user_id' => request('user_id')
    //             ]
    //         ]);
    //     } catch (\Exception $e) {
    //         return 'Error: ' . $e->getMessage();
    //     }

    //     dd($response);
    // }

    // public function detail($id)
    // {
    //     try {
    //         $getData = json_decode($this->getApiData('GET', [])->getBody()->getContents());
    //         $data = collect($getData)->where('id', $id)->firstOrFail();
    //     } catch (\Exception $e) {
    //         return 'Error: ' . $e->getMessage();
    //     }

    //     return view('detailsites', compact('data'));
    // }

    // public function destroy($id)
    // {
    //     $api = "https://jsonplaceholder.typicode.com/posts/{$id}";
    //     $client = new Client();

    //     $action = $client->request('DELETE', $api);

    //     dd(collect($action));
    // }

    // public function getImam()
    // {
    //     $apiResult = $this->client->request('GET', "{$this->url}/imam", [
    //         'headers' => [
    //             'Content-Type' => 'application/json'
    //         ]
    //     ]);

    //     $getquranApi = collect(json_decode($apiResult->getBody()));

    //     dd($getquranApi);
    // }

    // public function quranApi()
    // {
    //     $apiResult = $this->client->request('GET', "{$this->url}/quran", [
    //         'headers' => [
    //             'Content-Type' => 'application/json'
    //         ]
    //     ]);

    //     $getquranApi = collect(json_decode($apiResult->getBody()));

    //     dd($getquranApi);
    // }
}
