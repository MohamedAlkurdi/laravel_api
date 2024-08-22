<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    public function data()
    {
        $data = Test::all();
        $positive_response = [
            'status' => 200,
            'responseData' => $data,
        ];
        $negative_response = [
            'status' => 404,
            'responseData' => 'No data found.',
        ];

        if ($data->count() > 0) {
            return response()->json($positive_response, 200);
        } else {
            return response()->json($negative_response, 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'info' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ], 422);
        } else {
            $newTest = Test::create([
                'name' => $request->name,
                'info' => $request->info,
            ]);

            if ($newTest) {
                return response()->json([
                    'status' => 200,
                    'responseData' => "newTest was added successfully.",
                ], 200);
            } else {
                return response()->json([
                    'status' => 500,
                    'message' => 'Failed to post.',
                ], 500);
            }
        }
    }
}
