<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\FakeData;

class FakeDataController extends Controller
{
    public function index()
    {
        $fake_data = FakeData::get();
        if ($fake_data) {
            return response()->json($fake_data, 200);
        }
    }
}
