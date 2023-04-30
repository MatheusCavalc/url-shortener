<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LinkController extends Controller
{
    public function index() {
        $links = Link::with('user')->where('user_id', auth()->user()->id)->get();

        return response()->json($links, 200);
    }

    public function store(Request $request)
    {
        $request->request->add(['user_id' => auth()->user()->id]);

        $requestData = $request->all();
        $response = [];
        $validation = $this->validation($request->all());

        if (!is_array($validation)) {
            Link::create($requestData);
            array_push($response, ['status' => 'success']);
            return response()->json($response, 200);
        } else {
            return response()->json($validation, 400);
        }
    }

    public function show(Link $link)
    {
        return response()->json([
            'link' => $link,
        ]);
    }

    public function validation($params)
    {
        $response = [];
        $messages = [
            'max' => 'The :attribute field must NOT have more than :max characters',
            'required' => 'The :attribute field must NOT be empty',
            'quantity.numeric' => ':attribute must be numeric'
        ];
        $attributes = [
            'user_id' => 'user_id',
            'destination' => 'destination',
            'title' => 'title',
            'back_half' => 'back_half'
        ];
        $validation = Validator::make(
            $params,
            [
                'user_id' => 'required|max:80',
                'destination' => 'required|max:80',
                'title' => 'required|max:80',
                'back_half' => 'required|max:80',
            ],
            $messages,
            $attributes
        );

        if ($validation->fails()) {
            array_push($response, ['status' => 'error']);
            array_push($response, ['errors' => $validation->errors()]);
            return $response;
        } else {
            return true;
        }
    }
}
