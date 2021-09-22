<?php
namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller as Controller;

/**
 * @OA\Schema(
 *     title="BaseResponse",
 *     description="Base repsonse",
 *     @OA\Xml(
 *         name="BaseResponse"
 *     )
 * )
 */
class BaseController extends Controller
{
    /**
     * @OA\Property(
     *     title="success",
     *     format="int64",
     *     example=true
     * )
     *
     * @var bool
     */
    private $success;
     /**
     * @OA\Property(
     *     title="data",
     *     type="array",
     *     @OA\Items (
     *          type="array",
     *          @OA\Items()
     *      )
     * )
     *
     * @var array
     */
    private $data;
     /**
     * @OA\Property(
     *     title="message",
     * )
     *
     * @var string
     */
    private $message;

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message, $code = 200)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $code);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
