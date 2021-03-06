<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $error_codes = [400, 401, 402, 403, 404, 405, 406, 407, 408, 409, 410, 411, 412, 413, 414, 415, 416, 417, 418, 421, 422, 423, 424, 425, 426, 428, 429, 431, 451, 500, 501, 502, 503, 504, 505, 506, 507, 508, 510, 511];

    public function errorMessageRespond($message, int $statusCode)
    {
        return response()->json([
            'success' => false,
            'message' => "Error: {$message}"
        ], $statusCode);
    }

    protected function respondValidationError($data = [], $message = 'Validation Error!', $headers = [])
    {
        $result = [
            'status' => 'error',
            'status_code' => 400,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($result, 400, $headers);
    }

    public function respondErrorException($e, $request)
    {
        $data = [];
        $message = $e->getMessage();
        $trace = $e->getTraceAsString();
        Log::error($message, [$trace]);

        $data = [
            'success' => false,
            'status_code' => $e->getCode(),
            'message' => $message
        ];

        if (in_array($e->getCode(), $this->error_codes)) {
            return response($data, $e->getCode(), $request->header ?? []);
        } else {
            return response($data, 404);
        }
    }

}
