<?php

namespace App\Http\Controllers\Api\V0;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponder;

class ApiController extends Controller
{
    use ApiResponder;

    protected int $paginatePerPage = 15;
}
