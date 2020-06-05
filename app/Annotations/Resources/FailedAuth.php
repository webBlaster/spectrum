<?php
namespace App\Annotations\Resources;


/**
 * @OA\Schema(
 *     title="ImeiResource",
 *     description="Imei resource",
 *     @OA\Xml(
 *         name="ImeiResource"
 *     )
 * )
 */



class FailedAuth {


    /**
     * @OA\Property(
     *      title="message",
     *      description="User not authenticated or Token Expired",
     *      example="unauthenticated"
     * )
     *
     * @var string
     */
    private $message;
    
    /**
     * @OA\Property(
     *      title="status",
     *      description="status of response",
     *      example=0
     * )
     *
     * @var string
     */
    private $status;
}