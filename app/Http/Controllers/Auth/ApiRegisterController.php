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
        $err_array = [];
        $rules = array(
            'phone_number' => 'required',
            'password' => 'required'
        );    
        $messages = array(
            'phone_number.required' => 'Phone number is mandotory',
            'password.required' => 'Password is mandotory.'
        );
        
        $validator = Validator::make( $request->all(), $rules, $messages );
        
        foreach ($validator->errors()->getMessages() as $key => $value) {
            $arr = array(
                "code" => 1001,
                "message" => $value[0]
            );
            array_push($err_array,$arr);
        }

        if ( $validator->fails() ) 
        {
            return [
                'status' => "ERROR",
                'data' => [], 
                'errors' => $err_array
            ];
        }
        event(new Registered($user = $this->create($request->all())));
        return response($this->createResponse(['user' => $user]));
    }

    private function createResponse($payload) {
        return [
            'status' => 'SUCCESS',
            'data' => $payload,
            'errors' => []
        ];
    }
}
