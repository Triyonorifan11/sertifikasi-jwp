<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

define('OK', 200);
define('CREATED', 201);
define('ACCEPTED', 202);
define('NO_CONTENT', 204);
define('BAD_REQUEST', 400);
define('UNAUTHORIZED', 401);
define('FORBIDDEN', 403);
define('NOT_FOUND', 404);
define('METHOD_NOT_ALLOWED', 405);
define('NOT_ACCEPTABLE', 406);
define('REQUEST_TIMEOUT', 408);
define('CONFLICT', 409);
define('GONE', 410);
define('UNPROCESSABLE_ENTITY', 422);
define('TOO_MANY_REQUESTS', 429);
define('INTERNAL_SERVER_ERROR', 500);
define('NOT_IMPLEMENTED', 501);
define('BAD_GATEWAY', 502);
define('SERVICE_UNAVAILABLE', 503);
define('GATEWAY_TIMEOUT', 504);


class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    // call http response constant

    public  function responseAPI($data, $message, $code)
    {
        return response()->json([
            'data' => $data,
            'message' => $message,
        ], $code);
    }
}
