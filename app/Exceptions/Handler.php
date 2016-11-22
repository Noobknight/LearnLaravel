<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        NotFoundHttpException::class,
        ModelNotFoundException::class
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        if (in_array(get_class($exception), $this->dontReport)) {
            $this->handleApiException($exception);
        }
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
        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
            return response()->json(['token_expired'], $exception->getStatusCode());
        } else if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
            return response()->json(['token_invalid'], $exception->getStatusCode());
        }
        if($exception instanceof ModelNotFoundException){
            $message = [
                'status' => false,
                'error_code' => 404,
                'errors' => ["That resource doesn't exist"]
            ];
            return response()->json($message, 404);
        }
        if($exception instanceof NotFoundHttpException){
            $message = [
                'status' => false,
                'error_code' => 1235,
                'errors' => ["We don't have kind of resources"]
            ];
            return response()->json($message, 404);
        }

        if($exception instanceof BadRequestHttpException){
            $message = [
                'status' => false,
                'error_code' => 400,
                'errors' => ["Bad Request"]
            ];
            return response()->json($message, 400);
        }

        if($exception instanceof MethodNotAllowedException){
            $message = [
                'status' => false,
                'error_code' => 405,
                'errors' => ["Method Not Allowed"]
            ];
            return response()->json($message, 405);
        }

        if($exception instanceof Exception){
            $message = [
                'status' => false,
                'message' => $exception->getMessage()
            ];
            return response()->json($message, $exception->getCode());
        }

        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Illuminate\Http\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['error' => 'Unauthenticated.'], 401);
        }

        return redirect()->guest('login');
    }
}
