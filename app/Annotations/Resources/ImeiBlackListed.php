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



class ImeiBlacklisted {


    /**
     * @OA\Property(
     *      title="message",
     *      description="User Imei blaclisted due to 5 failed requests",
     *      example="The requested IMEI is blacklisted"
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