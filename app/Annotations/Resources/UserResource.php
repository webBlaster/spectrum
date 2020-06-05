<?php
namespace App\Annotations\Resources;

/**
 * @OA\Schema(
 *     title="UserResource",
 *     description="User resource",
 *     @OA\Xml(
 *         name="UserResource"
 *     )
 * )
 */

class UserResource {

    /**
     * @OA\Property(
     *      title="message",
     *      description="Suucess Response",
     *      example="Success, see attached books below"
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
     * @var \App\Annotations\Models\User[]
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