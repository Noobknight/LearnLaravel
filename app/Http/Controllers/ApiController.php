<?php
/**
 * Created by PhpStorm.
 * User: Tavv
 * Date: 17/11/2016
 * Time: 9:11 SA
 */

namespace App\Http\Controllers;


use Constant;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\ResponseFactory;
use stdClass;

class ApiController extends Controller
{
    public $response;
    public $request;

    private $MESSAGE_SUCCESS = "Success";
    private $MESSAGE_NO_CONTENT = "No Data";

    /**
     * ApiController constructor.
     * @param $response
     * @param $request
     */
    public function __construct(ResponseFactory $response, Request $request)
    {
        $this->response = $response;
        $this->request = $request;
    }


    public function responseEntity($data, $hasCount)
    {
        $message = [
            'status' => true,
            'data' => $data,
            'message' => sizeof($data) != 0 ? $this->MESSAGE_SUCCESS : $this->MESSAGE_NO_CONTENT,
            'count' => $hasCount ?  count($data) : null
        ];
        return response()->json($message, Response::HTTP_OK);
    }

    public function responseEntityErr($errors, $error_code, $status_code = 400)
    {
        if (is_string($errors)) {
            $errors = [$errors];
        }
        $message = [
            'status' => false,
            'error_code' => $error_code,
            'errors' => $errors
        ];
        return $this->response->json($message, $status_code);
    }


    public function responseNotFound($error_code, $message = "Resource not found")
    {
        return $this->responseEntityErr($message, $error_code);
    }

    public function responseInternalErr($error_code, $message = "Internal error")
    {
        return $this->responseEntityErr($message, $error_code);
    }


}