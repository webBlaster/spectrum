<?php

namespace App\Annotations\Models;


/**
 * @OA\Schema (
 *     title="Register Imei",
 *     description="Registers the user Imei",
*      required={"imei"}
 * )
 */
class UserImei {
      
    /**
     * @OA\Property(
     *     title="token",
     *     description="Authentication Token",
     *     example="jksnxoiscxsijsxosice-w0d90-d9w0d9wu9wwcbscsssd98cyhjosmxus="
     * )
     *
     * @var string
     */
    private $token;
    
    /**
     * @OA\Property(
     *     title="expires",
     *     description="Token Duration",
     *     example="60mins"
     * )
     *
     * @var string
     */
    private $expires;

    /**
     * @OA\Property(
     *     title="user_id",
     *     description="User's unique id",
     *     example="Xisuhsyusuxuisjeicjic-w0903"
     * )
     *
     * @var string
     */
    private $user_id;
    

}