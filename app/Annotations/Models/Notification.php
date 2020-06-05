<?php
namespace App\Annotations\Models;


/**
 * @OA\Schema (
 *     title="Notifications",
 *     description="Notifications Table"
 * )
 */
class Notification {
    

    /**
     * @OA\Property(
     *     title="Title",
     *     description="The title of the notification being sent",
     *     example="New App Release"
     * )
     *
     * @var string
     */
    private $title;

    /**
     * @OA\Property(
     *     title="Content",
     *     description="The content of the notification being sent",
     *     example="Due to the bug in the recent release of our app, we are releasing a fix "
     * )
     *
     * @var string
     */
    private $notitication;

    /**
     * @OA\Property(
     *     title="date",
     *     description="When the notification was sent",
     *     example="30/06/2020",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $date;
    
}