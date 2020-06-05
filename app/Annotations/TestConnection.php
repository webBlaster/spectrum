<?php
namespace App\Annotations;


class TestConnection {
     /**
     * @OA\Get(
     *      path="/test_connection",
     *      operationId="test_connection",
     *      tags={"Test if the API is accessible"},
     *      summary="Test if the endpoints works, nothing is required",
     *      description="Returns a success message",
     *      @OA\Parameter(
     *          name="APP-KEY",
     *          description="Authentication APIKEY is required",
     *          in="header",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="0105d248a8c694c2b0704eabdb2fbcd1"
     *          )
     * 
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="You have successfully reached the spectrum API endpoint"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated"
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
}