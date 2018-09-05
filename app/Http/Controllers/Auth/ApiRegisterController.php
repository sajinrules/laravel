<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Validator;

class ApiRegisterController extends RegisterController
{
    /**
     * Handle a registration request for the application.
     *
     * @override
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        // $messages = [
        //     'required'    => 'Mandatory field missing'
        // ];
        // $validator = Validator::make($input, $rules, $messages);
        // return $validator;
        // $errors = $this->validator($request->all())->errors();
        // //return $errors;

        // if(count($errors))
        // {
        //     return response(['errors' => $errors], 401);
        // }

        // event(new Registered($user = $this->create($request->all())));

        // //this->guard()->login($user);

        // return response(['user' => $user]);
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|unique:users',
        //     'body' => 'required',
        // ]);
        $rules = array(
            'password' => 'required',
            'phone_number' => 'required'
        );    
        $messages = array(
            'password.required' => 'Password is mandotory.',
            'phone_number.required' => 'Phone number is mandotory'
        );
        $validator = Validator::make( $request->all(), $rules, $messages );
        return $validator->errors();
        $err_array = $validator->errors();

        if ( $validator->fails() ) 
        {
            return [
                'status' => "ERROR",
                'data' => [], 
                'errors' => [
                    "0"=> $validator->errors(),
                    "1"=> $validator->errors()
                ]
            ];
        }
        
    }
}
