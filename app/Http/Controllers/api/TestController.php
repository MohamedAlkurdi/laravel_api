<?php
namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PDO;

class TestController extends Controller
{
    public function data()
    {
        $data = Test::all();
        if ($data->count() > 0) {
            return response()->json([
                'status' => 200,
                'responseData' => $data,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'responseData' => 'No data found.',
            ], 404);
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

    public function show($id)
    {
        $element = Test::find($id);
        if ($element) {
            return response()->json([
                'status' => 200,
                'data' => $element,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "element was not found."
            ], 404);
        }
    }

    public function edit($id)
    {
        $element = Test::find($id);
        if ($element) {
            return response()->json([
                'status' => 200,
                'data' => $element,
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => "element was not found."
            ], 404);
        }
    }

    public function update(Request $request,int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'info' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => "Failed to update."
            ], 422);
        } else {
            $element = Test::find($id);

            if ($element) {
                $element->update([
                    'name' => $request->name,
                    'info' => $request->info
                ]);
                return response()->json([
                    'status' => 200,
                    'responseData' => "Element was updated successfully.",
                ], 200);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Element not found.',
                ], 404);
            }
        }
    }

    public function delete($id){
        $element = Test::find($id);

        if($element){
            $element->delete();
            return response()->json([
                "status"=>200,
                "message"=>"deleted successully."
            ],200);
        }else{
            return response()->json([
                "status"=>404,
                "message"=>"element was not found."
            ],404);
        }
    }
}
