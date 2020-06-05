<?php

namespace App\Annotations\Models;


/**
 * @OA\Schema (
 *     title="Register User",
 *     description="User model",
*      required={"imei"}
 * )
 */
class User {
    

    /**
     * @OA\Property(
     *     title="User Id",
     *     description="The unique id attached to each users",
     *     example="4511bc60-a596-11ea-9fd6-e192a8af2bb6"
     * )
     *
     * @var string
     */
    private $user_id;
    
    /**
     * @OA\Property(
     *     title="Email",
     *     description="Email",
     *     example="mailer@cloudware.ng",
     *     format="email"
     * )
     *
     * @var string
     */
    private $email;

    /**
     * @OA\Property(
     *     title="first_name",
     *     description="The user's first name",
     *     example="Charles",
     *     format="string",
     *     type="string"
     * )
     *
     * @var string
     */
    private $first_name;

    /**
     * @OA\Property(
     *     title="last_name",
     *     description="The user's last name",
     *     example="Gabbage",
     *     format="string",
     *     type="string"
     * )
     *
     * @var string
     */
    private $last_name;

    /**
     * @OA\Property(
     *     title="phone",
     *     description="User's phone number",
     *     example="08100001111"
     * )
     *
     * @var string
     */
    private $phone;

    /**
     * @OA\Property(
     *     title="access_code",
     *     description="access code purchased to access a collection of books",
     *     example="6853-9147-3890-9073"
     * )
     *
     * @var string
     */
    private $access_code;
    

}