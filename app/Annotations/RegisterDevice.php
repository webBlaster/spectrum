<?php
namespace App\Annotations;


class TestConnection {
     /**
     * @OA\Post(
     *      path="/register_device",
     *      operationId="register_device",
     *      tags={"Registers a Device Imei"},
     *      summary="Accepts device Imei and return an authorization token to be used in future requests",
     *      description="Returns an authorization token",
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
     *      @OA\Parameter(
     *          name="imei",
     *          description="Accepts a device Imei",
     *          in="query",
     *          required=true,
     *          @OA\Schema(
     *              type="string",
     *              example="02909487857"
     *          )
     * 
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Success, Device Imei has been successfully registered",
     *          @OA\JsonContent(ref="#/components/schemas/RegisterImei")
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Couldn't login due to failed auhentication",
     *          @OA\JsonContent(ref="#/components/schemas/FailedAuth")
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="Imei BLacklisted and can no longer login (Imei gets blacklisted after 5 failed login attempts",
     *          @OA\JsonContent(ref="#/components/schemas/ImeiBlackListed")
     *      )
     *     )
     */
}