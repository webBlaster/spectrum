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

class RegisterImei {

    /**
     * @OA\Property(
     *      title="message",
     *      description="Response Text",
     *      example="Device Imei successfully Registered"
     * )
     *
     * @var string
     */
    private $message;
    
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Annotations\Models\UserImei[]
     */
    private $data;
    /**
     * @OA\Property(
     *      title="status",
     *      description="status of response",
     *      example=1
     * )
     *
     * @var string
     */
    private $status;


}