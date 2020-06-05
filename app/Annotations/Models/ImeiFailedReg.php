<?php

namespace App\Annotations\Models;


/**
*   @OA\Schema (
*     title="Register Imei",
*     description="Registers the user Imei",
*       type="array",
*       @OA\Items(
*           type="object",
*           @OA\Property(property="imei", type="integer")
*       )
*  )
*/
class ImeiFailedReg {
    
}