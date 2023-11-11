<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Auth;

trait HttpResponses
{
    protected function success($data, $message = null, $code = 200)
    {
        return response()->json([
            'status' => 'request was successful',
            'message' => $message,
            'data' => $data
        ], $code);
    }
    protected function error($data, $message = null, $code)
    {
        return response()->json([
            'status' => 'error .....',
            'message' => $message,
            'data' => $data
        ], $code);
    }

    protected function isAuthorize($Object)
    {

        return Auth::user()->id == $Object->user_id ? true : false;
    }
}
