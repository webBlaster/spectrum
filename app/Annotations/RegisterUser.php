<?php
namespace App\Annotations;


class TestConnection {
     /**
     * @OA\Post(
     *      path="/register_user",
     *      operationId="register_user",
     *      tags={"Registers users name against the earlier registered Imei"},
     *      summary="Accepts first_name, last_name, phone_number etc.",
     *      description="Returns a collection of books",
     *      @OA\Parameter(
     *          name="APP-KEY",
     *          description="Authentication KEY is required",
     *          in="header",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="0105d248a8c694c2b0704eabdb2fbcd1"
     *          )
     * 
     *      ),
     *       @OA\Parameter(
     *          name="Authorization",
     *          description="Authorization token is required",
     *          in="header",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="hijciscmusc8sucosijnossuchj-03390eu98ujw09mde9ekf09efi0-w90-owe0iwefe,fi0f9weif0-wi"
     *          )
     * 
     *      ),
     *      @OA\Parameter(
     *          name="user_id",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="iusiijxichimdioeueoiu"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="first_name",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="Charles"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="last_name",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="Gabbage"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="phone",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="08100000111"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="access_code",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="1234-5684-3949-9578"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Books Attached to the Access Code",
     *          @OA\JsonContent(ref="#/components/schemas/UserResource")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *          @OA\JsonContent(ref="#/components/schemas/FailedAuth")
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
}