<?php

namespace App\Http\Controllers;


class BaseController extends Controller {

    public function notFound($message = 'object not found') {
        return response()->json(['message' => $message], 404);
    }

    public function ok($data) {
        return response()->json($data, 200);
    }

    public function created($data) {
        return response()->json($data, 201);
    }
}