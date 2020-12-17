<?php

namespace App\Controllers\Dashboard\Employee;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;

class IndexController extends Controller
{
    public function display(Request $request, Response $response)
    {
        $response->view('dashboard/employee/index');
    }
}