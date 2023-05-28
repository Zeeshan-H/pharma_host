<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use App\Http\Response;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->headers->get('Content-Type') == 'application/json') {
        $validator = \Validator::make($request->all(), 
        [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]
    );
        if($validator->fails()) {
            $response = [
                'status' => 0,
                'error' => 'Validation error',
                'message' => $validator->errors()
            ];
            return response()->json($response, 400);
        }
        else {
        $input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ];

        // Check if email already exists or not
        if(User::checIfEmailExists($request->email)) {    

        $user = User::create($input);
        return [
            'status' => 1,
            'data' => $user
        ];
        }
        else {
            return [
                'status' => 0,
                'msg' => 'Email already exists!'
            ];
        }
    }
        }
        else 
        {
        return response()->json("Request header is missing", 500);
        }
    
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

}
