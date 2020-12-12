<?php

namespace App\Controllers\Dashboard;

use App\Core\Http\Response;
use App\Core\Http\Request;
use App\Core\Http\Controller;

class EmployeeController extends Controller
{
    public function index(Request $request, Response $response)
    {

        $response->view('/dashboard/employee/index', []);
    }
}