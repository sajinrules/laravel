<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        /*
            return response()->json([
                'error' => [Array(
                    'message' => 'Resource not found',
                    'code' => Response::HTTP_NOT_FOUND
                )]
            ], Response::HTTP_NOT_FOUND);
         
        */
        $err_code = 23000;$e->getCode();
        
        switch($err_code) {
            case 23000:
                $message = 'Phone number already exists';
                break;
            
                default :
                $message = 'Error occured';
                break;    
        }
        
        if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
            return response()->json($this->handleError($e,'Resource not found', Response::HTTP_NOT_FOUND), Response::HTTP_NOT_FOUND);
        
        } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return response()->json($this->handleError($e,'Endpoint not found', Response::HTTP_NOT_FOUND), Response::HTTP_NOT_FOUND);
        
        } else if($e instanceof \Illuminate\Validation\ValidationException) {
            return response()->json($this->handleError($e,'Validation error', Response::HTTP_NOT_FOUND), Response::HTTP_NOT_FOUND);
        }
        
        return response()->json($this->handleError($e, $message, Response::HTTP_BAD_REQUEST), Response::HTTP_BAD_REQUEST);
        
    }

    public function handleError($e, $msg, $code){
        return [
            'status' => 'ERROR',
            'data' => [],
            'errors' => [ Array(
                'message' => $msg,
                'code' => $code
            )]
        ];   
    }
    
}
