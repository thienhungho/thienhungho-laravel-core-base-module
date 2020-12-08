<?php

namespace Thienhungho\Modules\CoreBase\Http\Controllers;

use Thienhungho\Modules\CoreBase\Http\Controllers\AbstractController;
use Thienhungho\Modules\CoreBase\Http\Traits\RestAPIResponseTrait;

abstract class AbstractRestAPIController extends AbstractController
{
    use RestAPIResponseTrait;
}
