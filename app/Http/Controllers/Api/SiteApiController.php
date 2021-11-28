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

    private function valueModified(string $type, $value)
    {
        $allowedType = ['ucwords', 'ucfirst', 'lcfirst', 'strtoupper', 'strtolower'];

        if (!in_array($type, $allowedType)) {
            throw new \Exception("Your input Type is Not Allowed!", 405);
        } else {
            switch ($type) {
                case "ucwords":
                    $value = ucwords($value);
                    break;
                case "ucfirst":
                    $value = ucfirst($value);
                    break;
                case "lcfirst":
                    $value = lcfirst($value);
                    break;
                case "strtoupper":
                    $value = strtoupper($value);
                    break;
                case "strtolower":
                    $value = strtolower($value);
                    break;
                default:
                    echo null;
            }
        }

        return $value;
    }

    public function index()
    {
        try {
            $data = SiteQueries::getDataList('GET', 'surah');

            if (empty($data)) return back();
            else
                $data = $data->map(function ($item) {
                    return [
                        'id' => !(int)$item->number || is_string($item->number) ? null : (int)$item->number,
                        'name' => $item->name->short,
                        'id_name' => $this->valueModified('strtoupper', $item->name->transliteration->id)
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
                    'id' => !(int)$data->number || is_string($data->number) ? null : (int)$data->number,
                    'name' => ucfirst($data->name->short),
                    'id_name' => $this->valueModified('ucwords', $data->name->transliteration->id),
                    'tafsir' => $this->valueModified('ucfirst', $data->tafsir->id)
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
