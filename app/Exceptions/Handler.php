<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
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
    public function render($request, Exception $exception)
    {
        if ($exception instanceof UnauthorizedHttpException) {
            $preException = $exception->getPrevious();
            if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) 
            {
                return response()->json(['status'=>['code'=>-1,'is_clean'=>false,'message'=>'TOKEN_EXPIRED']],200);    
            } 
            else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) 
            {        
                return response()->json(['status'=>['code'=>-1,'is_clean'=>false,'message'=>'TOKEN_INVALID']],200);    
            } 
            else if ($preException instanceof \Tymon\JWTAuth\Exceptions\TokenBlacklistedException) 
            {         
                return response()->json(['status'=>['code'=>-1,'is_clean'=>false,'message'=>'TOKEN_BLACKLISTED']],200);   
            }   
            if ($exception->getMessage() === 'Token not provided') {       
                return response()->json(['status'=>['code'=>-1,'is_clean'=>false,'message'=>'Token not provided']],200);   
            }
        }
        return parent::render($request, $exception);
    }
}
