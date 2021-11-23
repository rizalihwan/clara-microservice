<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\Site\SiteQueries;
use Illuminate\Support\Facades\Validator;

class SiteApiController extends Controller
{
    static $tripayRules = [
        'code' => 'required'
    ];

    static $tripayMessageValidation = [
        'required' => ':attribute wajib diisi.'
    ];

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
            return $this->errorMessageRespond("data tidak dapat di Peroleh {$th->getMessage()}", $th->getCode());
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
                    'id_name' => $data->name->transliteration->id,
                    'tafsir' => $data->tafsir->id
                ];
            } catch (\Exception $ex) {
                return $this->errorMessageRespond("data tidak dapat di Peroleh {$ex->getMessage()}", $ex->getCode());
            } catch (\Error $err) {
                return $this->errorMessageRespond($err->getMessage(), $ex->getCode());
            }
        } else {
            abort(404);
        }

        return view('detailsites', compact('data'));
    }

    public function paymentInstruction()
    {
        try {
            $validator = Validator::make(request()->all(), static::$tripayRules, static::$tripayMessageValidation);

            if ($validator->fails()) {
                $errors = collect();
                foreach ($validator->errors()->getMessages() as $value) {
                    foreach ($value as $error) {
                        $errors->push($error);
                    }
                }

                return $this->respondValidationError($errors);
            } else {
                $requiredRequest = [
                    'code' => request('code')
                ];

                $optionalRequest = [
                    'pay_code' => request('pay_code') ?? null,
                    'amount' => request('amount') ?? null,
                    'allow_html' => request('allow_html') ?? null
                ];

                $response = SiteQueries::getTripayData('GET', 'payment/instruction', [
                    'headers' => ['Authorization' => request()->header('Authorization')],
                    'json' => array_merge($requiredRequest, $optionalRequest)
                ]);

                return data_get($response, "data");
            }
        } catch (\Exception $e) {
            return $this->respondErrorException($e, request());
        }
    }
}
