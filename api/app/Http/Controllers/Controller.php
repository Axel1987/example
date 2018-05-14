<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    /**
     * @SWG\Swagger(
     *     @SWG\Info(
     *         version="1.0.0",
     *         title="Talent documentations",
     *         @SWG\License(name="MIT")
     *     ),
     *     host="",
     *     basePath="/",
     *     schemes={"http"},
     *     consumes={"application/json"},
     *     produces={"application/json"}
     * )
     */
    
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
